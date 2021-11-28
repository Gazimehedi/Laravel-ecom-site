<table>
    <tr>
        <td><h3>Welcome {{$name}}</h3></td>
    </tr>
    <tr>
        <td><h4>Please active your account</h4></td>
    </tr>
    <tr>
        <td><a href="{{url('mail_verification/'.$rand_id)}}">Click here</a> to verify your email id</td>
    </tr>
</table>