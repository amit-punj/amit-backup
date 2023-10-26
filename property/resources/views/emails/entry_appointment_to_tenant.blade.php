@include('emails.layout.header')
<body id="email" style="background-color: rgb(23,23,23); font-size: 16px; color: rgb(243,243,243); line-height: 1.5; align-items: center; font-family: 'IBM Plex Sans'; margin: 0; padding: 0;">
    <table style="width:80%; margin-left: 10%;">
        <tr>
            <td style="font-family: 'IBM Plex Sans'; height: 48px; text-align: center; width: 100%;" width="100%" height="48" align="center">
                <span style="font-size: 14px; color: rgb(255,255,255); font-weight: 300;">Reasy Property</span>
            </td>
        </tr>
    </table>
    <hr style="border: none; border-bottom: 1px solid rgb(61,61,61);">
    <table style="width: 90%; margin-left: 5%;">
        <tr>
            <td colspan="4" style="font-family: 'IBM Plex Sans';">
                <span style="font-size: 28px; color: #000;">Hi, {{ ucfirst($name) }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="font-family: 'IBM Plex Sans'; padding: 15px 0px;">
                <p style="margin:0;">
                    You just booked a appointment on {{$time}}
                </p>
            </td>
        </tr>
    </table>
    <table style="margin-left: 5%">
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 15px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                Your appointment details  
            </td>
        </tr>
        <tr style="margin-left: 30px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
            <td style="font-family: 'IBM Plex Sans';">
                &nbsp;&nbsp;&nbsp; Time 
            </td>
            <td style="font-family: 'IBM Plex Sans';">
                &nbsp;&nbsp;&nbsp; {{ $time }}
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 30px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                &nbsp;&nbsp;&nbsp; Title:
            </td>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 30px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                &nbsp;&nbsp;&nbsp; {{ $title }}:
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 30px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                &nbsp;&nbsp;&nbsp; Description:
            </td>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 30px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                &nbsp;&nbsp;&nbsp; {{ $description }}:
            </td>
        </tr>
    </table>

    <table style="margin-left: 5%">
        <tr>
            <td style="font-family: 'IBM Plex Sans'; padding: 15px 0px;">
                List of documents to bring when coming for meeting with Property Expert:
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 15px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                1. Passport
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 15px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                2. Aadhar Card
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 15px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                3. Votar Card
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; margin-left: 15px; font-size: 14px; line-height: 1.6; letter-spacing: 0.16px;">
                4. Letter head
            </td>
        </tr>
    </table>
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
                <img src="http://angular.visionvivante.com/twitter-icon.png" style="height: 17px; padding-top: 15px;">

            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; height: 48px; text-align: center; width: 100%;" width="100%" height="48" align="center">
                <span style="font-size: 14px; color: rgb(255,255,255); font-weight: 300;">Trading</span>
                <span style="font-size: 14px; font-weight: 600; color: rgb(255,255,255);">Platform</span>
            </td>
        </tr>
    </table>
@include('emails.layout.footer')
</body>

</html>