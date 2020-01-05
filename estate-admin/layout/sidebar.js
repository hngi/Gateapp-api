document.write(`
<div class="col-12 dash-logo">
    <img class="ml-3 mt-3" src="../images/GateGuardLogo.svg" alt="" />
</div>
<ul class="list-unstyled components">
    <p onclick="location.href='dashboard-initial.html'">
        <img src="../images/mdi-view-dashboard.svg" alt="Dashboard" style="margin-right: 20px; margin-bottom: 6px;" />Dashboard
    </p>
    <li class="">
        <a onclick="location.href='dashboard-residents.html'" data-toggle="collapse" aria-expanded="false"><img src="../images/mdi-account-group.svg" alt="Admins" style="margin-right: 20px; margin-bottom: 6px;" />Residents</a>
    </li>
    <li>
        <a onclick="location.href='estate_guards_dash.html'" data-toggle="collapse" aria-expanded="false"><img src="../images/OfficerAsset 1.svg" alt="Guards" style="margin-right: 20px; margin-bottom: 6px;" />Guards</a>
    </li>
    <li>
        <a onclick="location.href='estate_visitors_dash.html'" data-toggle="collapse" aria-expanded="false"><img src="../images/whh-visitor.svg" alt="Visitors" style="margin-right: 20px; margin-bottom: 6px;" />Visitors</a>
    </li>
    <li>
        <a href="" data-toggle="collapse" aria-expanded="false"><img src="../images/entypo-tools.svg" alt="ServiceProviders" style="margin-right: 20px; margin-bottom: 6px;" />Service Providers</a>
    </li>
    <li>
        <a onclick="location.href='payments_overview.html'" data-toggle="collapse" aria-expanded="false"><img src="../images/ic-twotone-payment.svg" alt="Payments" style="margin-right: 20px; margin-bottom: 6px;" />Payments</a>
    </li>
    <!--<li>
        <a href="" data-toggle="collapse" aria-expanded="false"><img src="../images/mdi-message-reply.svg" alt="Messages" style="margin-right: 20px; margin-bottom: 6px;" />Messages</a>
    </li>
    <li>
        <a href="" data-toggle="collapse" aria-expanded="false"><img src="../images/Icon.svg" alt="Settings" style="margin-right: 20px; margin-bottom: 6px;" />Settings</a>
    </li>-->
</ul>`);
