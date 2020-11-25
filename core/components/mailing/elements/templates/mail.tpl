<!DOCTYPE>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <title>Lorem ipsum dolor sit amet</title>
    {$styles}
</head>
<body>

<table class="body-wrap">

    <tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="alert alert-good">
                            Lorem ipsum dolor sit amet
                        </td>
                    </tr>
                    <tr>
                        <td class="content-wrap">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="content-block">
                                        Dear <strong>{$_modx->getPlaceholder('user.fullname')}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Neque porro quisquam <strong>est qui dolorem ipsum</strong> quia dolor sit amet,
                                        consectetur, adipisci velit..."
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <a href="#" class="btn-primary">Nulla blanditt</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Thanks for choosing {$_modx->config.site_name}.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table width="100%">
                        <tr>
                            <td class="aligncenter content-block">
                                <strong>{$_modx->config.site_name}</strong>
                                © {'' | date : 'Y'}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>
