<p>Hi,</p>
<p>Berikut adalah Contact Baru yang kami terima:</p>
<p>Nama : {{$contact->name}}</p>
<p>Email : {{$contact->email}}</p>
<p>Subject : {{$contact->subject}}</p>
<p>Message : {{$contact->message}}</p>
<p>Dikirim Pada : {{date("d M Y", strtotime($contact->created_at))}}</p>