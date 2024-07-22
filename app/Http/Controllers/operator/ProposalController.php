<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Photo;
use App\Models\File;
use App\Models\Status;
use App\Models\Sekolah; // Menggunakan model Sekolah
use App\Models\Kecamatan;
use App\Model\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function index()
{
    // Dapatkan ID pengguna yang sedang login
    $userId = Auth::id();

    // Filter proposal berdasarkan id_user yang sesuai dengan pengguna yang sedang login
    $proposals = Proposal::with(['photos', 'files', 'status', 'sekolah','user'])
                ->where('id_user', $userId)
                ->get();

    // Kirim data ke view
    return view('operator.proposal.index', compact('proposals'));
}

    public function create()
    {
        $sekolahList = Sekolah::all();
        $statusList = Status::all();
        $kecamatanList = Kecamatan::all(); // Ambil semua kecamatan dari tabel Kecamatan
        return view('operator.proposal.create', compact('sekolahList', 'statusList', 'kecamatanList'));
    }    


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'id_sekolah' => 'required|exists:sekolah,id_sekolah',
        'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'files.*' => 'file|mimes:pdf,doc,docx,xls,xlsx',
        'panjanglokasi' => 'required|string|max:255', // Validasi untuk panjanglokasi
        'lebarlokasi' => 'required|string|max:255', // Validasi untuk lebarlokasi
        'kecamatan_id' => 'required|exists:kecamatans,id', // Validasi untuk kecamatan_id
        'tanggal' => 'required|date', // validasi untuk tanggal
    ]);

    $user = Auth::user();

    $proposal = Proposal::create([
        'title' => $request->title,
        'description' => $request->description,
        'id_sekolah' => $request->id_sekolah,
        'status_id' => $request->status_id,
        'id_user' => $user->id,
        'telepon' => $user->telepon,
        'panjanglokasi' => $request->panjanglokasi, // Menyimpan nilai panjanglokasi dari form
        'lebarlokasi' => $request->lebarlokasi, // Menyimpan nilai lebarlokasi dari form
        'kecamatan_id' => $request->kecamatan_id, // Menyimpan nilai kecamatan_id dari form
        'tanggal' => $request->tanggal, // tambahkan 'tanggal' disini
    ]);

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('public/uploads/photos');
            Photo::create(['proposal_id' => $proposal->id, 'filename' => $path]);
        }
    }

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('public/uploads/files');
            File::create(['proposal_id' => $proposal->id, 'filename' => $path]);
        }
    }

    return redirect()->route('operator.proposal.index')->with('success', 'Proposal berhasil dibuat.');
}


    public function show(Proposal $proposal)
    {
        $proposal->load('photos', 'files', 'status', 'sekolah', 'comments'); // Load comments with user

        return view('operator.proposal.show', compact('proposal'));
    }


    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        $sekolahList = Sekolah::all();
        $statusList = Status::all();
        $kecamatanList = Kecamatan::all();
        return view('operator.proposal.edit', compact('proposal', 'sekolahList', 'statusList', 'kecamatanList'));
    }


    public function update(Request $request, Proposal $proposal)
{
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'id_sekolah' => 'required|exists:sekolah,id_sekolah',
        'status_id' => 'required|exists:statuses,id',
        'panjanglokasi' => 'required|string|max:255',
        'lebarlokasi' => 'required|string|max:255',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'files.*' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        'comment' => 'nullable|string|max:1000', // Validasi untuk komentar
        'tanggal' => 'required|date', // Validasi untuk tanggal
    ]);

    $proposal->update([
        'title' => $request->title,
        'description' => $request->description,
        'id_sekolah' => $request->id_sekolah,
        'status_id' => $request->status_id,
        'panjanglokasi' => $request->panjanglokasi,
        'lebarlokasi' => $request->lebarlokasi,
        'kecamatan_id' => $request->kecamatan_id,
        'tanggal' => $request->tanggal, // Update tanggal
    ]);

    if ($request->hasFile('photos')) {
        foreach ($proposal->photos as $photo) {
            Storage::delete($photo->filename);
            $photo->delete();
        }

        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('public/uploads/photos');
            Photo::create(['proposal_id' => $proposal->id, 'filename' => $path]);
        }
    }

    if ($request->hasFile('files')) {
        foreach ($proposal->files as $file) {
            Storage::delete($file->filename);
            $file->delete();
        }

        foreach ($request->file('files') as $file) {
            $path = $file->store('public/uploads/files');
            File::create(['proposal_id' => $proposal->id, 'filename' => $path]);
        }
    }

    // Simpan komentar baru jika ada
    if ($request->comment) {
        $proposal->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ]);
    }

    return redirect()->route('operator.proposal.index')->with('success', 'Proposal berhasil diperbarui.');
}


    



    public function destroy(Proposal $proposal)
    {
        foreach ($proposal->photos as $photo) {
            Storage::delete($photo->filename);
            $photo->delete();
        }

        foreach ($proposal->files as $file) {
            Storage::delete($file->filename);
            $file->delete();
        }

        $proposal->delete();

        return redirect()->route('operator.proposal.index')->with('success', 'Proposal berhasil dihapus.');
    }


    public function downloadFile($fileId)
    {
        $file = File::findOrFail($fileId);
        return Storage::download($file->filename);
    }

    public function downloadPhoto($photoId)
    {
        $photo = Photo::findOrFail($photoId);
        return Storage::download($photo->filename);
    }

    public function sendWhatsAppMessage($proposalId)
{
    $proposal = Proposal::findOrFail($proposalId);
    $phoneNumber = $proposal->telepon;
    $message = 'Kami dari Admin, Ingin memberitahukan kalau Proposal anda Sudah Di verifikasi';

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(
        'target' => $phoneNumber, // Nomor telepon tujuan
        'message' => $message,    // Pesan yang ingin dikirim
        // Tambahkan parameter lain sesuai kebutuhan
      ),
      CURLOPT_HTTPHEADER => array(
        'Authorization: 7NU@zaQxvg4fDgRnwPQY' // Ganti dengan token Fonnte Anda
      ),
    ));

  // Eksekusi cURL
  $response = curl_exec($curl);
  if (curl_errno($curl)) {
      $error_msg = curl_error($curl);
      curl_close($curl);
      // Redirect dengan pesan kesalahan jika terjadi error
      return redirect()->route('operator.proposal.index')->with('error', 'Gagal mengirim pesan: ' . $error_msg);
  }
  curl_close($curl);

  // Mengecek respon API dan menentukan redirect
  if ($response) {
      $responseDecoded = json_decode($response, true);
      // Jika respon berhasil dan sesuai dengan yang diharapkan
      if (isset($responseDecoded['status']) && $responseDecoded['status'] == 'success') {
          return redirect()->route('operator.proposal.index')->with('success', 'Pesan WhatsApp berhasil dikirim.');
      } else {
          // Jika respon tidak sesuai dengan yang diharapkan
          return redirect()->route('operator.proposal.index')->with('error', 'Gagal mengirim pesan WhatsApp.');
      }
  }

  // Redirect default jika tidak ada respon atau respon tidak dapat di-decode
  return redirect()->route('operator.proposal.index')->with('error', 'Tidak ada respon dari API.');
}
}

