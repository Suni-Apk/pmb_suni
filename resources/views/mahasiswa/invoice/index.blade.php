<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Data Atas Nama </title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}

			.border{
				border:#333 3px;
			}
		</style>
	</head>

	<body>
		@php
			$general = App\Models\General::first();
			$nama = Auth::user();
		@endphp
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
                <td>
                  <img src="{{$general->image}}" alt="">
                </td>

								<td>
									Data Atas Nama {{$nama->name}}: <br />
									Created {{date('Y - m - d')}}: <br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{$general->title}}.<br />
									{{$general->name}}
								</td>

								<td>
									.<br />
									<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Pembayaran</td>

					<td>Check #</td>
				</tr>

				@php
					$biaya = App\Models\Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', Auth::user()->biodata->angkatan_id)->latest()->first();

					$user = Auth::user();
					$tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();
					$transaksis = App\Models\Transaksi::where('user_id',$user->id)
						->get();
					$transaksiCicilan = App\Models\Cicilan::where('id_tagihan_details',$tagihan->id)->where('status','LUNAS')
					->get();
					// dd($transaksiCicilan);
					// Menghitung total pembayaran yang telah dilakukan
					// $transaksiCash = App\Models\Transaksi::where('user_id',Auth::user()->id)->where('jenis_pembayaran','cash')->where('status','berhasil')->first();
					$transaksiCash = App\Models\Transaksi::where('user_id', $user->id)
                                ->where('tagihan_detail_id', $tagihan->id)
                                ->where('jenis_tagihan', $biaya->jenis_biaya)
                                ->where('status', 'berhasil')
                                ->first();
					
					$angkatan = App\Models\Biodata::where('user_id',$user->id)->where('program_belajar','S1')->first();
					$biaya = App\Models\Biaya::where('id_angkatans',$angkatan->id)->where('jenis_biaya','Routine')->first();
					$transaksiRoutine = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
						->where('id_users', $user->id)
						->where('status', 'LUNAS')
						->get();
				@endphp
				@if ($invoicecek == 'DaftarUlang')
					@if (!$transaksiCash && $transaksis)
					@php
						$nomor = 1;
					@endphp
					@foreach ($transaksiCicilan as $item)
						@php
							$transaksi = App\Models\Transaksi::where('user_id',$user->id)
						->where('id_cicilans',$item->id)
						->get();
						@endphp
						@foreach ($transaksi as $value)
								<tr>
									<td>Cicilan {{$nomor++}}: </td>
									<td>Rp. {{number_format(round($value->total), 0, '', '.')}},-</td>
								</tr>
								<tr>
									<td>No Invoice</td>
									<td>{{ $value->no_invoice }}</td>
								</tr>
						@endforeach
						@endforeach
						{{-- @foreach ($transaksi as $item)
							<tr class="details">
								<td>Cicilan {{$loop->iteration}}: </td>
								<td>Rp. {{number_format(round($item->total), 0, '', '.')}},-</td>
							</tr>
							<tr>
								<td>No Invoice</td>
								<td>{{ optional($item->transaction)->no_invoice }}</td>
							</tr>
						@endforeach --}}
					@elseif($transaksiCash && !$transaksis)
						<tr class="details">
							<td>Daftar Ulang Cash: </td>
							<td>Rp. {{number_format(round($transaksiCash->total),0,'','.')}},-</td>
						</tr>
					@endif
				@elseif($invoicecek == 'Routine')
					@foreach ($transaksiRoutine as $item)
						<tr class="border">
							<tr>
								<td>Pembayaran Bulan {{$item->tagihans->mounth}}: </td>
								<td>Rp. {{number_format(round($item->amount), 0, '', '.')}},-</td>
							</tr>
							<tr>
								<td>No Invoice</td>
								<td>{{ optional($item->transaction)->no_invoice }}</td>
							</tr>
						</tr>
					@endforeach
				@endif



				<tr class="heading">
					<td>Status Pembayaran</td>
					
					<td>#Check</td>
				</tr>
				@php
					$angkatan = App\Models\Biodata::where('user_id',$user->id)->where('program_belajar','S1')->first();
					$biaya = App\Models\Biaya::where('id_angkatans',$angkatan->id)->where('jenis_biaya','Routine')->first();
					$sppTagihan = App\Models\TagihanDetail::where('id_biayas',$biaya->id)->sum('amount');
					$total_routine = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
						->where('id_users', $user->id)
						->where('status', 'LUNAS')
						->sum('amount');
					$sisaBelum = $sppTagihan - $total_routine;
				@endphp
				@if ($invoicecek == 'DaftarUlang')
					<tr class="item">
						<td>Total : </td>

						<td>
							Rp. {{number_format($transaction->sum('total'),0,'','.')}},-
						</td>
					</tr>
				@elseif($invoicecek == 'Routine')
					
					@if ($sppTagihan != $total_routine)
						<tr class="item">
							<td>Total : </td>

							<td>
								Rp. - {{number_format($sisaBelum,0,'','.')}},-
							</td>
						</tr>
					@else
						<tr class="item">
							<td>Total : </td>

							<td>
								Rp. {{number_format($total_routine,0,'','.')}},-
							</td>
						</tr>
					@endif
				@endif


                <tr class="item">
					<td>Status : </td>

					<td>
                        @php
                            $biaya = App\Models\Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', Auth::user()->biodata->angkatan_id)->latest()->first();

                            $user = Auth::user();
                            $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();

                            // Menghitung total pembayaran yang telah dilakukan
							$total_pembayaranCicilan = ceil(App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)
							->where('status', 'LUNAS')
							->sum('harga') / 2) * 2;

                            $total_pembayaranCash = App\Models\Transaksi::where('user_id', $user->id)
                                ->where('jenis_tagihan', 'DaftarUlang')
								->where('program_belajar','S1')
                                ->where('status', 'berhasil')
								->where('total',$tagihan->amount)
								->first();
							$angkatan = App\Models\Biodata::where('user_id',$user->id)->where('program_belajar','S1')->first();
							$biaya = App\Models\Biaya::where('id_angkatans',$angkatan->id)->where('jenis_biaya','Routine')->first();
							$sppTagihan = App\Models\TagihanDetail::where('id_biayas',$biaya->id)->sum('amount');
							$total_routine = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
								->where('id_users', $user->id)
								->where('status', 'LUNAS')
								->sum('amount');
							// dd($tagihan->amount);
							// dd($total_pembayaranCicilan);
                        @endphp
						@if ($invoicecek == 'DaftarUlang')
							@if ($total_pembayaranCicilan && !$total_pembayaranCash)
								@if ($total_pembayaranCicilan != $tagihan->amount)
									Belum Lunas
								@else
									Lunas
								@endif	
							@elseif($total_pembayaranCash && !$total_pembayaranCicilan)
								@if (round($total_pembayaranCash->amount) != $tagihan->amount)
									Belum Lunas
								@else
									Lunas
								@endif
							@endif
						@elseif($invoicecek == 'Routine')
							@if ($sppTagihan != $total_routine)
								Belum Lunas
							@else
								Lunas
							@endif
						@endif
                    </td>
				</tr>

			</table>
		</div>
	</body>
</html>