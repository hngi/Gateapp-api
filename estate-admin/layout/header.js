document.write(
  `
<div class="innerContent">
  <nav
    id="header"
    class="navbar navbar-toggleable-md navbar-inverse navbar-expand-lg d-flex justify-content-md-around align-items-start mb-1"
  >
    <a class="navbar-brand peace-header" style="margin-top: -10px;" href="/"
      >Peace Estate
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <form method="get" class="form-inline mr-4 ml-4">
      <div class="form-group header-form d-flex align-items-center">
        <img
          src="../images/search.jpeg"
          width="16px"
          height="16px"
          alt="Search"
          style="opacity: 0.5;"
        /><input
          type="text"
          placeholder="Search residents..."
          class="form-control header-input bg-white"
        />
      </div>
    </form>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav d-flex justify-content-between icons">
        <li class="nav-item dropdown message">
          <div class id="dropdownMenuButton" style="cursor: pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../images/message.svg" alt="Message" style="margin-left: -8px;" />
          </div>
          <div class="dropdown-menu ml-2 shadow-lg p-3 mb-5 bg-white rounded w3-animate-left" style="width: 27.56rem;" aria-labelledby="dropdownMenuButton">
          <div class="d-flex flex-row mb-3 align-items-center">
            <div style="background-color: #e6f4ff; border-radius: 50%; padding: 15px 15px;"  class="mr-3" >    
              <img src="../images/Group 3.png" width="24px" height="24px" alt="People" />
            </div>
            <div class="d-flex flex-column justfity-content">
              <p style="color: #141821; font-size: 16px; margin-bottom: -2px">New message from John</p>
              <p style="color: #858997; font-size: 14px">12 min ago</p>
            </div>
          </div>
          <div class="d-flex flex-row mb-3 align-items-center">
            <div style="background-color: #e6f4ff; border-radius: 50%; padding: 15px 15px;"  class="mr-3" >    
              <img src="../images/Group 3.png" width="24px" height="24px" alt="People" />
            </div>
            <div class="d-flex flex-column justfity-content">
              <p style="color: #141821; font-size: 16px; margin-bottom: -2px">New message from John</p>
              <p style="color: #858997; font-size: 14px">12 min ago</p>
            </div>
          </div>
          <div class="d-flex flex-row mb-3 align-items-center">
            <div style="background-color: #e6f4ff; border-radius: 50%; padding: 15px 15px;"  class="mr-3" >    
              <img src="../images/Group 3.png" width="24px" height="24px" alt="People" />
            </div>
            <div class="d-flex flex-column justfity-content">
              <p style="color: #141821; font-size: 16px; margin-bottom: -2px">New message from John</p>
              <p style="color: #858997; font-size: 14px">12 min ago</p>
            </div>
          </div>
          </div>
        </li>
        <li class="nav-item dropdown bell">
            <div class id="dropdownMenuButton" style="cursor: pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="../images/Bell.svg" alt="Bell" style="margin-left: -4px;" />
            </div>
            <div class="dropdown-menu ml-2 shadow-lg p-3 mb-5 bg-white rounded w3-animate-left" style="width: 27.56rem;" aria-labelledby="dropdownMenuButton">
              <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                <p style="color: #858997; font-size: 16px">3 Notifications</p>
                <p style="color: #858997; font-size: 16px">Clear all</p>
              </div>
              <div class="d-flex flex-row mb-3">
                  <img src="../images/VectorTools.svg" width="60px" height="60px" class="pl-3 pr-3 mr-3" alt="People" style="background-color: #e6f4ff; border-radius: 50%" />
                <div class="d-flex flex-column justfity-content">
                  <p style="color: #141821; font-size: 16px; margin-bottom: -2px">New service provider received</p>
                  <p style="color: #858997; font-size: 14px">12 min ago</p>
                </div>
              </div>
              <div class="d-flex flex-row mb-3">
                  <img src="../images/flat-color-icons_money-transfer.svg" width="60px" height="60px" class="pl-3 pr-3 mr-3" alt="People" style="background-color: #e6f4ff; border-radius: 50%" />
                <div class="d-flex flex-column justfity-content">
                  <p style="color: #141821; font-size: 16px; margin-bottom: -2px">Bill payment</p>
                  <p style="color: #858997; font-size: 14px">39 min ago</p>
                </div>
              </div>
              <div class="d-flex flex-row mb-3">
                  <img src="../images/VectorStamp.svg" width="60px" height="60px" class="pl-3 pr-3 mr-3" alt="People" style="background-color: #e6f4ff; border-radius: 50%" />
                <div class="d-flex flex-column justfity-content">
                  <p style="color: #141821; font-size: 16px; margin-bottom: -2px">Visitor checked in</p>
                  <p style="color: #858997; font-size: 14px">2 hours ago</p>
                </div>
              </div>
            </div>
        </li>
        <li class="nav-item d-flex flex-row align-items-start justify-content-between">
          <img src="../images/Person.svg" alt="You" srcset=""  style="margin-right: 10px;" />
          <div class="d-flex flex-column" style="width: inherit;">
            <p style="font-size: 16px;">Frederick Damascus</p>
            <p style="font-size: 10px; margin-top: -1.5em;">ADMIN</p>
          </div>
        </li>
        <li class="nav-item dropdown arrow">
          <div style="cursor: pointer;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img
            src="../images/chevron-down.svg"
            width="14px"
            height="20px"
            alt="Down"
            style="margin-left: -4px;"
          />
          </div>
          <div class="dropdown-menu ml-2 shadow-lg p-3 mb-5 bg-white rounded w3-animate-left" aria-labelledby="dropdownMenuButton" style="width: 13.93rem;">
            <div class="d-flex flex-row mb-3 align-items-center">
              <div style="background-color: #edf6ed; border-radius: 50%; padding: 5px 7px;" class="mr-2">
                <img src="../images/Settings.png" width="16px" height="16px" class="mb-1" alt="People" />
              </div>
              <p style="color: #686868; font-size: 14px" class="mt-2">Profile settings</p>
            </div>
            <div class="d-flex flex-row mb-3 align-items-center" >
              <div style="background-color: #edf6ed; border-radius: 50%; padding: 5px 7px;" class="mr-2">
                <img src="../images/Logout2.png" width="15px" height="15px" class="mb-1" alt="People" />
              </div>
              <p style="color: #686868; font-size: 14px" class="mt-2">Logout</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>
`
);
