<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td>
            </td>
            <td align="right">
            </td>
        </tr>
        <tr style="background-color: #cc3535 " height="5px" width="100%">
            <td colspan="3">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p align="center" style="margin:50px 50px">
                    <font size="6" color="#204056">New Support Message</font>
                </p>
            </td>
        </tr>
        <tr style="background-color:#fff">
            <td valign="top" height="51px" width="100%" colspan="3">
                <div id="m_5512663084909233652ufModal"
                    class="m_5512663084909233652ui-dialog-content m_5512663084909233652ui-widget-content"
                    style="min-height:116px;height:auto;display:block;line-height:200%;font-weight:300">
                    <div style="margin:50px 50px">
                        <font color="#204056">
                            <h1 style="line-height:200%;font-weight:300">
                                Hello,
                            </h1>
                            <h3 style="line-height:200%;font-weight:300">
                                There is a new message from
                                {{ $data['email'] }}
                            </h3>
                            <p style="line-height:200%;font-weight:300">Login into your account to check <a
                                    href="{{ config('app.fe_url') }}/login.html">Login</a></p>
                        </font>
                    </div>
                </div>
            </td>
        </tr>
        <tr height="1px" width="100%" style="background-color:#f1f2f2">
            <td colspan="3"></td>
        </tr>
        <tr style="background-color:#e6e7e8" height="50px">
            <td>
                <font color="#BCBEC0">
                    <p style="margin:0px 0px 0px 50px">
                </font>
            </td>
            <td width="100px"></td>
            <td align="center">
                <font color="#BCBEC0">
                    <p> &nbsp;&nbsp; © {{ date('Y') }}
                        <span class="il">{{ config('app.name') }}</span>
                    </p>
                </font>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center" style="margin:20px 20px" height="80px">
                <div style="font-size:10px;color:gray;line-height:200%;font-weight:300">

                </div>
            </td>
        </tr>
    </tbody>
</table>
