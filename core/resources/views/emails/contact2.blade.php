<p>Hai {{$contact->name}},</p>
<p>Terimakasih telah mengirim pesan, berikut adalah rincian pesan yang Anda kirimkan:</p>
<p>Nama : {{$contact->name}}</p>
<p>Email : {{$contact->email}}</p>
<p>Subject : {{$contact->subject}}</p>
<p>Message : {{$contact->message}}</p>
<p>Dikirim Pada : {{date("d M Y", strtotime($contact->created_at))}}</p>
<p>
	Terimakasih
</p>