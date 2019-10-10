<!DOCTYPE html>
    <html lang="en-US">
    	<head>
    		<title>Welcome</title>
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
    				color: lightgreen;
    				background: white;
    				border: 1px solid lightgreen;
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
                    color: lightgreen !important;
    			}
    			.note{
    				font-weight: bold;
    				text-align: center;
                    color: black !important;
    			}

    		</style>
    	</head>
    	<body>
    		<div>
    			
    		</div>
    		<h2 class="welcome">Welcome To Gate Pass</h2>
    		<div>
    			 <h4>Hello {{$user->first_name}} {{$user->last_name}}</h4>
    		</div>
    		<div>
    			 <p class="note">Use this verification token to confirm account</p>
    			 <p class="verifycode">{{ $user->verifycode}}</p>
    		</div>
    	</body>
    </html>