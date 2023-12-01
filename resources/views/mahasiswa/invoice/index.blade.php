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
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
                <td>
                  <img src="" alt="">
                </td>

								<td>
									Data Atas Nama #: <br />
									Created: <br />
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
									PPDB Al-Romusa, Inc.<br />
									Yogyakarta<br />
									Pondok Informatika Al-madinah
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

					// Menghitung total pembayaran yang telah dilakukan
					$transaksiCicilan = App\Models\Cicilan::where('id_tagihan_details',$tagihan->id)->where('status','LUNAS')
						->get();
					// $transaksiCash = App\Models\Transaksi::where('user_id',Auth::user()->id)->where('jenis_pembayaran','cash')->where('status','berhasil')->first();
					$transaksiCash = App\Models\Transaksi::where('user_id', $user->id)
                                ->where('tagihan_detail_id', $tagihan->id)
                                ->where('jenis_tagihan', $biaya->jenis_biaya)
                                ->where('status', 'berhasil')
                                ->first();
				@endphp

				@if (!$transaksiCash && $transaksiCicilan)
					@foreach ($transaksiCicilan as $item)
						<tr class="details">
							<td>Cicilan {{$loop->iteration}}: </td>

							<td>Rp. {{number_format(round($item->harga),0,'','.')}},-</td>
						</tr>
					@endforeach
				@elseif(!$transaksiCicilan && $transaksiCash)
					<tr class="details">
						<td>Daftar Ulang Cash: </td>

						<td>Rp. {{number_format(round($transaksiCash->total),0,'','.')}},-</td>
					</tr>
				@endif


				<tr class="heading">
					<td>Status Pembayaran</td>
					
					<td>#Check</td>
				</tr>

				<tr class="item">
					<td>Total : </td>

					<td>
                        Rp. {{number_format($transaction->sum('total'),0,'','.')}},-
                    </td>
				</tr>


                <tr class="item">
					<td>Status : </td>

					<td>
                        @php
                            $biaya = App\Models\Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', Auth::user()->biodata->angkatan_id)->latest()->first();

                            $user = Auth::user();
                            $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();

                            // Menghitung total pembayaran yang telah dilakukan
							$total_pembayaranCicilan = round(App\Models\Cicilan::where('id_tagihan_details',$tagihan->id)->where('status','LUNAS')
                                ->sum('harga'));
                            $total_pembayaranCash = round(App\Models\Transaksi::where('user_id', $user->id)
                                ->where('tagihan_detail_id', $tagihan->id)
                                ->where('jenis_tagihan', $biaya->jenis_biaya)
                                ->where('status', 'berhasil')
                                ->where('jenis_pembayaran','cicil')
                                ->sum('total'));
                        @endphp
                        @if (!$total_pembayaranCicilan)
							
						@else
							@if ($total_pembayaranCicilan != $tagihan->amount)
								Belum Lunas
							@else
								Lunas
							@endif			
						@endif
						@if (!$total_pembayaranCash)
							
						@else
							@if ($total_pembayaranCash != $tagihan->amount)
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