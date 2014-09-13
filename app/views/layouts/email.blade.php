<!DOCTYPE html>
<html>
<head>
	<title>@yield('title_short')</title>
	<link rel="important stylesheet" href="chrome://messagebody/skin/messageBody.css">
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #555555; margin: 0; padding: 0; color: #555555;">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" height="100%" bgcolor="#555555" id="main">
        <tr>
            <td align="center" valign="top" style="font-size: 11px; font-family: Arial, Verdana, sans-serif;">
                <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr id="top">
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="text-align: left; padding: 15px 0px 0px 20px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 3px;">
                            <table border="0" cellpadding="0" cellspacing="0" id="outline" style="border: 1px solid #6c6c6c; width: 100%; text-align: left;" bgcolor="#ffffff">
                                <tr>
                                    <td>
                                        <table cellpadding="20" cellspacing="0" border="0" height="100" style="border-bottom: 20px solid #0099d9; width: 100%; height: 100px;" bgcolor="#474747">
                                            <tr>
                                                <td valign="middle"><a href="http://www.keepusup.com/">
                                                    <img src="{{ asset('assets/img/logo.png') }}" alt="KeepUsUp" border="0"/></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle">
                                        <table cellpadding="20" cellspacing="0" border="0" style="width: 100%; min-height: 350px; font-family: Arial, Verdana, sans-serif;">
                                            <tr>
                                                <!-- start body copy -->
                                                <td valign="top" width="450">
                                                    <h1 style="font-family: Arial, Verdana, sans-serif; font-size: 22px; color: #555555;">@yield('title_long')</h1>
                                                    <p style="color: #555555; font-size: 12px; line-height: 20px;">
                                                        @yield('body')
                                                    </p>
                                                </td>
                                                <td valign="top" width="169" style="border-left: 1px solid #cccccc;">
                                                    <p style="color: #555555; font-size: 12px; line-height: 20px;">
                                                        <strong>{{ trans('layouts.aboutkuu') }}</strong>
                                                        <br /><br />
                                                        {{ trans('layouts.kuumission') }}
                                                    </p>                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr bgcolor="#edeff0" width="100%">
                                    <td align="center" valign="top" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color: #666666;">
                                        <table cellspacing="0" border="0" cellpadding="20" width="100%" style="border-top: 1px solid #c0c0c0;">
                                            <tr>
                                                <td align="left" valign="middle" style="font-size: 11px; line-height: 16px; font-family: Arial, Verdana, sans-serif; color: #666666;">
                                                    <strong>{{ trans('layouts.questions') }}</strong> <a href="mailto:support@keepusup.com" style="outline: none; color: #00aeef; font-weight: bold; text-decoration: none;">{{ trans('layouts.contact_cs') }}</a>.<br />
                                                    {{ trans('layouts.replyemail') }}<br />
                                                    <br />
                                                    &copy; KeepUsUp</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- end outline table -->
                            <br />
                            <br />
                        </td>
                    </tr>
                </table>
                <!-- end holder -->
            </td>
        </tr>
    </table>
    <!-- end main table -->
</body>
</html>
