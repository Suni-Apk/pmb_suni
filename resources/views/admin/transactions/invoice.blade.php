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
									Data Atas Nama {{$user->name}}: <br />
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

				<tr>
					<td>{{$transaction->jenis_tagihan}} : </td>
					<td>Rp. {{number_format(round($transaction->total), 0, '', '.')}},-</td>
				</tr>
				<tr>
					<td>No Invoice</td>
					<td>{{ $transaction->no_invoice }}</td>
				</tr>
                <tr>
					<td>Jenis Tagihan</td>
					<td>{{ $transaction->jenis_tagihan }} {{$transaction->program_belajar}}</td>
				</tr>



				<tr class="heading">
					<td>Status Pembayaran</td>
					
					<td>#Check</td>
				</tr>

				<tr class="item">
					<td>Total : </td>

					<td>
                        Rp. {{number_format($transaction->total,0,'','.')}},-
                    </td>
				</tr>


                <tr class="item">
					<td>Status : </td>

					<td>
						{{$transaction->status}}
                    </td>
				</tr>

			</table>
		</div>
	</body>
</html>