@include('emails.layout.header')
<body id="email" style="background-color: rgb(23,23,23); font-size: 16px; color: rgb(243,243,243); line-height: 1.5; align-items: center; font-family: 'IBM Plex Sans'; margin: 0; padding: 0;">
    <table style="width:80%; margin-left: 10%;">
        <tr>
            <td style="font-family: 'IBM Plex Sans'; height: 48px; text-align: center; width: 100%;" width="100%" height="48" align="center">
                <img src="../admin_asset/img/logo-login.png" width="74" height="24" aria-hidden="true" style="margin-bottom:16px;" alt="TukTuk">
                <!-- <span style="font-size: 14px; color: rgb(255,255,255); font-weight: 300;">TukTuk Cab</span> -->
            </td>
        </tr>
    </table>
    <hr style="border: none; border-bottom: 1px solid rgb(61,61,61);">
    <table style="width: 90%; margin-left: 5%;">
        <tr>
            <td colspan="4" style="font-family: 'IBM Plex Sans';">
                <span style="font-size: 28px; color: #000;">Hi, {{$firstname}}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="font-family: 'IBM Plex Sans'; padding: 15px 0px;">
                <p style="margin:0;">
                    <p>We've received a request to reset your password. If you didn't make the request, just ignore this email. Otherwise, you can reset your password using the code give below:</p>
                </p>
            </td>
        </tr>
    </table>
    
            <p style="font-family: 'IBM Plex Sans'; font-size: 24px; line-height: 1.6; letter-spacing: 0.16px; text-align: center;">
                Your Password Reset Code is:  
            </p>
        
           <p style="margin-top: 0px; text-align: center; font-size: 18px; line-height: 1.6; letter-spacing: 0.16px;"> {{$forgot_code}} </p>
       
    <hr style="border: none; border-bottom: 1px solid rgb(61,61,61);">
    <table style="text-align: center; width: 100%">
        <tr>
            <td style="font-family: 'IBM Plex Sans';">
                <span>Have a quetsion?</span><a href="" style="text-decoration: none;
            color: rgb(107,164,255);"> Contact us</a>

            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans';">
                <img src="" style="height: 17px; padding-top: 15px;">

            </td>
        </tr>
    </table>
</body>
@include('emails.layout.footer')
