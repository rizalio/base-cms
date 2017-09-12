<!DOCTYPE html>
<html>
    <head>
        <title>Whoops.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }

            .btn {
            	padding: 12px 18px;
            	border: 1px solid #B0BEC5;
            	text-decoration: none;
            	transition: all .5s;
            	color: #B0BEC5;
            }

            .btn:hover {
            	background-color: #B0BEC5;
            	color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">You don't have permission <br>to this page.</div>
                <a href="javascript:history.back(-1);" class="btn">
                	Bring me Back
                </a>
            </div>
        </div>
    </body>
</html>
