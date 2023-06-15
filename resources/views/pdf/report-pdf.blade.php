<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVIS | Collateral Site Visit</title>

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="images/favicon.png">

    <!-- StyleSheets  -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->

    <style>
        body {
            font-size: 10.5pt;
            font-family: sans-serif;
        }

        .table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        tr,
        td {
            padding: 0px;
            text-align: left;
        }

        .top {
            vertical-align: top;
        }

        .contentx {
            margin-left: 6px;
        }

        .content {
            margin-left: 5px;
        }

        tbody {
            text-align: center;
        }

        .responsive {
            width: 100%;
            height: auto;
        }

    </style>
</head>
@php
$district = strtolower($transaction->customer->districtCustomer->name);
$city = strtolower($transaction->customer->cityCustomer->name);
$address = ucwords($transaction->customer->address) . ' ' . ucwords($district) . ' ' . ucwords($city);
$ao_names = strtolower($transaction->customer->ao_name) ?? '';

$space = Str::length($address); 
$agunan = '';
switch($transaction->customer->covis_type_id) {
    case '1':
        $agunan = 'apartment';
    break;
    case '2':
        $agunan = 'tanah kosong';
    break;
    case '3':
        $agunan = 'tanah kosong';
    break;
    case '4':
        $agunan = 'lain';
    break;
    case '5':
        $agunan = 'lain';
    break;
    case '6':
        $agunan = 'kios';
    break;
    case '7':
        $agunan = 'mesin';
    break;
    case '8':
        $agunan = 'tanah kosong';
    break;
    case '9':
        $agunan = 'persediaan barang';
    break;
    case '10':
        $agunan = 'tanah kosong';
    break;
    case '11':
        $agunan = 'tanah kosong';
    break;
    case '12':
        $agunan = 'tanah kosong';
    break;
    case '13':
        $agunan = 'tanah kosong';
    break;
}
@endphp
<body style="margin-top: -40px;">
    <h3 style="text-align: center;">LAPORAN SITE VISIT</h3>
    <table class="table">
        <tbody>
            <tr>
                <td colspan="2">
                    <div class="contentx">Nama Debitur</div>
                    <div class="contentx">Cabang Pemohon</div>
                    @if ($space > 128)
                        <div class="contentx">Lokasi / Alamat Agunan </div> <br>
                    @else
                        <div class="contentx">Lokasi / Alamat Agunan</div>
                    @endif
                    
                    <div class="contentx">Tanggal Peninjauan</div>
                    <div class="contentx">Nama AO</div>
                </td>
                <td colspan="1">
                    <div class="contentx" style="margin-left: -350px;"> :</div>
                    <div class="contentx" style="margin-left: -350px;"> :</div>
                    @if ($space > 128)
                        <div class="contentx" style="margin-left: -350px;">:</div> <br>
                    @else
                        <div class="contentx" style="margin-left: -350px;">:</div>
                    @endif
                    <div class="contentx" style="margin-left: -350px;"> :</div>
                    <div class="contentx" style="margin-left: -350px;"> :</div>
                </td>
                <td colspan="1">
                    <div class="contentx" style="margin-left: -597px;"> {{ $transaction->customer->name }}</div>
                    <div class="contentx" style="margin-left: -597px;">BCA {{ $transaction->customer->branch->name }}</div>
                    <div class="contentx" style="text-align: left; margin-left: -597px;">{{ $address }}</div>
                    @if($transaction->backdate)
                        <div class="contentx" style="margin-left: -597px;"> {{ Carbon\Carbon::parse($transaction->backdate)->isoFormat('dddd, D MMMM Y') }}</div>
                    @elseif($transaction->nexdate)
                        <div class="contentx" style="margin-left: -597px;"> {{ Carbon\Carbon::parse($transaction->nexdate)->isoFormat('dddd, D MMMM Y') }}</div>
                    @else
                        <div class="contentx" style="margin-left: -597px;"> {{ Carbon\Carbon::parse($transaction->visited_at)->isoFormat('dddd, D MMMM Y') }}</div>
                    @endif
                    <div class="contentx" style="margin-left: -597px;"> {{ ucwords($ao_names) }}</div>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black; border-right: 1px solid black;">
                @if ((int) $transaction->customer->covis_type_id == 7)
                    <td colspan="4">
                        @php
                            $trans_note = strtolower($transaction->note);
                        @endphp
                        <div class="contentx">Photo-Photo <span style="margin-left: 77.5px;">:</span> <span style="margin-left: 3px;">{{ ucwords($trans_note) }}</span> </div>
                    </td>
                @else
                    <td colspan="4">
                        <div class="contentx">Photo-Photo</div>
                    </td>
                @endif
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td style="width: 25%; height: 25%; text-align: center; padding: 1px;">
                    {{-- <img src="images/sample/sample1.jpeg" class="responsive"> --}}
                    <img style="width: 100%; height: 25%;" src="{{ asset('/images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $transaction->transactionImage->photo_right) }}"
                        alt="" class="responsive">
                </td>
                <td style="width: 25%; height: 25%; text-align: center; padding: 1px;">
                    {{-- <img src="images/sample/sample2.jpeg" class="responsive"> --}}
                    <img style="width: 100%; height: 25%;" src="{{ asset('/images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $transaction->transactionImage->photo_front1) }}"
                        alt="" class="responsive">
                </td>
                <td style="width: 25%; height: 25%; text-align: center; padding: 1px;">
                    {{-- <img src="images/sample/sample3.jpeg" class="responsive"> --}}
                    <img style="width: 100%; height: 25%;" src="{{ asset('/images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $transaction->transactionImage->photo_front2) }}"
                        alt="" class="responsive">
                </td>
                <td style="width: 25%; height: 25%; text-align: center; padding: 1px;">
                    {{-- <img src="images/sample/sample4.jpeg" class="responsive"> --}}
                    <img style="width: 100%; height: 25%;" src="{{ asset('/images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $transaction->transactionImage->photo_left) }}"
                        alt="" class="responsive">
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td style="text-align: center;"> @if ($transaction->customer->covis_type_id == 7) VIEW MESIN A @elseif ($transaction->customer->covis_type_id == 9) PERSEDIAAN BARANG A @else TAMPAK KANAN @endif </td>
                <td style="text-align: center;"> @if ($transaction->customer->covis_type_id == 7) VIEW MESIN B @elseif ($transaction->customer->covis_type_id == 9) PERSEDIAAN BARANG B @else TAMPAK DEPAN A @endif </td>
                <td style="text-align: center;"> @if ($transaction->customer->covis_type_id == 7) VIEW MESIN C @elseif ($transaction->customer->covis_type_id == 9) PERSEDIAAN BARANG C @else TAMPAK DEPAN B @endif </td>
                <td style="text-align: center;"> @if ($transaction->customer->covis_type_id == 7) VIEW MESIN D @elseif ($transaction->customer->covis_type_id == 9) PERSEDIAAN BARANG D @else TAMPAK KIRI @endif </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="top">
                                <div class="content">Keterangan:</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="top" style="width: 19%;">
                                <div class="content">
                                    1. Jenis Agunan
                                </div>
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $agunan == 'tanah kosong' ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">
                                Tanah Kosong & Tanah Bangunan
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $agunan == 'apartment' ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">
                                Apartemen
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $agunan == 'kios' ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 5%;">
                                Kios
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $agunan == 'mesin' ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 5%;">
                                Mesin
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $agunan == 'persediaan barang' ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 19%;">
                                Persediaan Barang Dagang / Bahan Baku
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $agunan == 'lain' ? 'checked' : '' }}>
                            </td>
                            <td class="top">
                                Lain-Lain
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="top" style="width: 19%;">
                                <div class="content">
                                    2. Jika Persediaan Barang Dagang / Bahan Baku
                                </div>
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox">
                            </td>
                            <td class="top" style="width: 33%;">
                                Jumlah Barang Sesuai Yang Tercantum Dalam Surat Daftar Persediaan Barang
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox">
                            </td>
                            <td class="top">
                                Jumlah Barang Tidak Sesuai Yang Tercantum Dalam Surat Daftar Persediaan Barang
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="top" style="width: 19%;">
                                <div class="content">
                                    3. Kondisi Agunan
                                </div>
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_condition_id == 1 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">Terawat</td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_condition_id == 2 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">Tidak Terawat</td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_condition_id == 3 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 12%;">Lain-Lain</td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_condition_id == 4 ? 'checked' : '' }}>
                            </td>
                            <td class="top">
                                Tampak Belakang Tidak Terjangkau Untuk Difoto
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="top" style="width: 19%;">
                                <div class="content">
                                    4. Penggunaan Agunan
                                </div>
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_used_for_id == 1 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">
                                Dipakai Sendiri
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_used_for_id == 2 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">
                                Disewakan
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox" {{ $transaction->covis_used_for_id == 3 ? 'checked' : '' }}>
                            </td>
                            <td class="top">
                                Lain-Lain
                            </td>
                            <!--<td class="top" style="width: 1%;">-->
                            <!--    <input type="checkbox" {{ $transaction->covis_used_for_id == 4 ? 'checked' : '' }}>-->
                            <!--</td>-->
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="top" style="width: 19%;">
                                <div class="content">
                                    5. Akses Jalan Ke Agunan
                                </div>
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox"
                                    {{ $transaction->covis_access_type_id == 1 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">
                                Dapat Dilalui Oleh Min. 2 Kendaraan Roda 4
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox"
                                    {{ $transaction->covis_access_type_id == 2 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 16%;">
                                Hanya Dapat Dilalui Oleh 1 Kendaraan Roda 4
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox"
                                    {{ $transaction->covis_access_type_id == 3 ? 'checked' : '' }}>
                            </td>
                            <td class="top" style="width: 12%;">
                                Jalan Setapak
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox"
                                    {{ $transaction->covis_access_type_id == 4 ? 'checked' : '' }}>
                            </td>
                            <td class="top">
                                Lain-Lain
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="top" style="width: 19%;">
                                <div class="content">
                                    Kesimpulan Oleh AO Cabang
                                </div>
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox">
                            </td>
                            <td class="top" style="width: 34%;">
                                Tidak Ada Perubahan Fisik / Peruntukan / Hal Lainnya Yang Dapat Merugikan BCA
                            </td>
                            <td class="top" style="width: 1%;">
                                <input type="checkbox">
                            </td>
                            <td class="top">
                                Ada Perubahan Fisik / Peruntukan / Hal Lainnya Yang Dapat Merugikan BCA
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; padding-top: 10px;">
        @php
            $adminSurveyor = App\Models\User::where('job_position_id', 6)->where('is_active', 1)->first(); 
            $spvSurveyor = App\Models\User::where('job_position_id', 4)->first();
            $ao_name = strtolower($transaction->customer->ao_name) ?? '';
        @endphp
        <tbody>
            <tr>
                <td style="text-align: center;">
                    Surveyor,
                        <br>
                        <img style="height: 53px; width:53px;" src="{{ asset('/images/tanda_tangan/' . $transaction->surveyor->ttd_users) }}" alt="{{$transaction->surveyor->ttd_users}}">
                        <br>
                    ( {{ $transaction->surveyor->name }} )
                </td>
                <td style="text-align: center;">
                    Admin Officer,
                    <br>
                    <img style="height: 53px; width:53px;" src="{{ asset('/images/tanda_tangan/' . $adminSurveyor->ttd_users) }}" alt="{{$adminSurveyor->ttd_users}}">
                    <br>
                    ( {{ $admin->name }} )
                </td>
                <td style="text-align: center;">
                    Supervisor,
                    <br>
                    <img style="height: 53px; width:53px;" src="{{ asset('/images/tanda_tangan/' . $spvSurveyor->ttd_users) }}" alt="{{$spvSurveyor->ttd_users}}">
                    <br>
                    ({{ $spvSurveyor->name }})
                </td>
                <td style="text-align: center;">
                    Account Officer
                    <br><br><br><br>
                    ( {{ ucwords($ao_names) }} )
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</body>

</html>
