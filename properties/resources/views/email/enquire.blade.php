<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>agent customer inquires</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300" rel="stylesheet">
<style>
@media only screen and (max-width: 600px) {
  .btn {
    width: 20%;
  }

  .clm {
    width: 35%;
  }

  .clm1 {
    width: 65%;
  }
}
@media only screen and (max-width: 414px) {
  .btn {
    width: 10%;
  }
}
</style></head>
<body id="email" style="background-color: rgb(23,23,23); font-size: 16px; color: rgb(243,243,243); line-height: 1.5; align-items: center; font-family: 'IBM Plex Sans'; margin: 0; padding: 0;">
    <table style="width:80%; margin-left: 10%;">
        <tr>
            <td style="font-family: 'IBM Plex Sans'; height: 48px; text-align: center; width: 100%;" width="100%" height="48" align="center">
                <span style="font-size: 14px; color: rgb(255,255,255); font-weight: 300;">Agent</span>
                <span style="font-size: 14px; font-weight: 600; color: rgb(255,255,255);">Connect</span>
            </td>
        </tr>
    </table>
    <hr style="border: none; border-bottom: 1px solid rgb(61,61,61);">
    <table style="width: 90%; margin-left: 5%;">
        <tr>
            <td colspan="4" style="font-family: 'IBM Plex Sans';">
                <span style="font-size: 28px; color: rgb(243,243,243);">Agent customer inquires</span>
            </td>
        </tr>
        <tr>
            <td>User Name</td>
            <td>{{ $username }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $email }}</td>

        </tr>
        <tr>
            <td>Phone</td>
            <td>{{ $phone }}</td>

        </tr>
        <tr>
            <td>Purpose</td>
            <td>{{ $purpose }}</td>
        </tr>
    </table>
    <br>
    <table style="margin-left: 5%; width: 90%;">
        <tr>
            <td style="font-family: 'IBM Plex Sans';">
               Property Detail Customer:
            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans';">
                <table style="width: 100%; padding: 10px 15px; border-bottom: 1px solid rgb(61,61,61);">
                    <tr>
                        <td style="width: 25%; font-family: 'IBM Plex Sans';" class="clm" width="25%">
                            <span style="font-size: 14px;  ">Description</span>

                        </td>
                       <td style="width: 75%; font-family: 'IBM Plex Sans';" class="clm1" width="75%">
                            <span style="font-size: 14px;">{{ $detail }}
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="text-align: center; width: 100%">
        <tr>
            <td style="font-family: 'IBM Plex Sans';">
                <span></span><a href="" style="text-decoration: none;
    color: rgb(107,164,255);"> Contact us</a>

            </td>
        </tr>
        <tr>
            <td style="font-family: 'IBM Plex Sans'; height: 48px; text-align: center; width: 100%;" width="100%" height="48" align="center">
                <span style="font-size: 14px; color: rgb(255,255,255); font-weight: 300;">Agent</span>
                <span style="font-size: 14px; font-weight: 600; color: rgb(255,255,255);">Connect</span>
            </td>
        </tr>
    </table>


    <table style="padding: 0; margin: 0; background-color: rgb(40,40,40); text-align: center; width: 100%; height: 100%; bottom: 0; text-align: center; align-items: center; ">
        <tr>
            <td style="font-family: 'IBM Plex Sans';">
                <p style="width: 60%; margin-left: 20%; font-style: italic; font-size: 12px; color: rgb(190,190,190); padding: 10px 0px;">
                    <a href="" style="text-decoration: none;
    color: rgb(107,164,255);">mail@gmail.com</a></p>
            </td>
        </tr>
    </table>
</body>

</html>