<!DOCTYPE html>
    <html lang="en-US">
    	<head>
            <title>GateGuard Super Admin</title>
    		<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
    		<style type="text/css">
    			* {
    				box-sizing: border-box;
    				padding: 0;
    				margin: 0;
    			}
    			body {
    				background: white;
    				color: black !important;
    			}
    			.verifycode {
    				color: #49a347;
    				background: white;
    				border: 1px solid #49a347;
    				text-align: center;
    				padding: 10px 50px 10px 50px;
    				width: 50%;
    				margin: auto;
    				font-size: 20px;
    				font-weight: bold;
    			}
    			.welcome{
    				font-weight: bold;
    				text-align: center;
                    color: #49a347 !important;
    			}
    			.note{
    				font-weight: bold;
    				text-align: center;
                    color: black !important;
    			}
                .team{
                    font-weight: normal;
                    font-size: 15px;
                    text-align: center;
                    color: grey !important;
                }

    		</style>
    	</head>
    	<body>
    		<div>
    			
    		</div>
    		<h2 class="welcome">GateGuard Super Admin</h2>
    		<div>
    			 <h4 style="color: grey;">Hello {{$name}} </h4>
    		</div>
    		<div>
				 <p class="note">You have been added as a super admin to GateGuard App</p>
    			 <p class="note">Use this current email and password to login into your account!</p>
    			 <p class="verifycode">{{ $password }}</p>
    		</div><br><br>

            <div>
                 <p class="team">if this mail is not authourize by you please discard! Thank you</p>
                 <p class="team" style="font-style: italic;">GateGuard Team</p>
            </div>

			<a style="color: #49a347;" href="gateguard.co">Go to GateGuard</a>
    	</body>
    </html>