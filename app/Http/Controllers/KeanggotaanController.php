<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keanggotaan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QRCodeData;
use Illuminate\Support\Str;


class KeanggotaanController extends Controller
{
    public function index(): View
    {
        $keanggotaans = Keanggotaan::all();
        return view('halaman.daftar', compact('keanggotaans'));
    }

    public function barcode()
    {
        return view('halaman.barcode');
    }

    public function showQRReader()
    {
        return view('halaman.qrreader');
    }

        public function generateQRCode(Request $request): View
    {
        $username = $request->input('username');
        $qrCode = QrCode::size(300)->generate($username);

        // Simpan QR code ke dalam database
        $qrCodeData = new QRCodeData();
        $qrCodeData->username = $username;
        $qrCodeData->qr_code = $qrCode;
        $qrCodeData->save();

        // Kembalikan view dengan QR code dan username
        return view('halaman.daftar', compact('qrCode', 'username'));
    }

    public function generateBarcode(Request $request)
    {
        $barcodeText = $request->input('barcode_text');
        $barcode = DNS1D::getBarcodeHTML($barcodeText, 'C128');

        return view('halaman.barcode', compact('barcode'));
    }
    // public function generateQRCode(Request $request): View
    // {
    //     $username = $request->input('username');
    //     $qrCode = QrCode::size(300)->generate($username);
    //     // Anda bisa menyimpan QR code ke database di sini jika diperlukan
    //     return view('halaman.daftar', compact('qrCode', 'username'));
    // }

    public function indexAnggota(): View
    {
        $keanggotaans = Keanggotaan::all();
        return view('halaman.anggota', compact('keanggotaans'));
    }
    public function showAbsenPage()
    {
        return view('halaman.absen');
    }

    public function searchByUsername(Request $request)
    {
        $username = $request->input('username');
        $keanggotaan = Keanggotaan::where('username', $username)->first();
        return view('halaman.absen', compact('keanggotaan'));
    }

    public function create(): View
    {
        $keanggotaans = Keanggotaan::all();
        return view('halaman.daftar', compact('keanggotaans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'username' => 'required',
            'jenkel' => 'required|in:Laki-Laki,Perempuan',
            'telepon' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload for photo
        $imageName = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
        }

        // Generate QR code
        $username = $request->input('username');
        $qrCode = QrCode::size(300)->generate($username);
        $qrCodePath = 'qr_codes/' . time() . '_' . Str::random(10) . '.png';
        file_put_contents(public_path($qrCodePath), $qrCode);

        // Save membership data to the database
        Keanggotaan::create([
            'nama' => $request->input('nama'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'username' => $username,
            'jenkel' => $request->input('jenkel'),
            'telepon' => $request->input('telepon'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'foto' => $imageName,
            'qr_code' => $qrCodePath,
        ]);

        return redirect()->route('daftar.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function destroy($id): RedirectResponse
    {
        // Temukan dan hapus anggota berdasarkan ID
        $anggota = Keanggotaan::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');

    }
}
