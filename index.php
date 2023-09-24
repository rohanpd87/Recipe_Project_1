<?php
//index.php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="comment.css">
    <link rel="shortcut icon" href="download-icon.jpg" type="image/x-icon">
    <title>Chaat Section - Taste ur Buds</title>
</head>
<body>
    <div class="container">
        <div class="navcon">
            <nav class="navbar navbar-dark bg-dark">
                <ul>
                    <div class="head">
                        <li>
                            <img src="download-icon.jpg" alt="code" id="code">
                        </li>
                        <li id="h1">
                            <h1>Taste ur Buds</h1>
                        </li>
                    </div>
                    <li id="l1">
                        <a href="home.html" style="font-family: cursive;">Home</a>
                        <a href="#" style="font-family: cursive;">Comment Us</a>
                        <a href="contact.html" style="font-family: cursive;">Contact Us</a>
                    </li>
                </ul>
            </nav>
        </div>
        <main>
            <div class="maincont">
                <div class="maincont1">
                    <h2 style="padding: 1.5em; padding-bottom: .6em; font-family: fantasy; color: orangered; display: flex; align-items: center; justify-content: center; letter-spacing: .25em;">
                        Who we are?
                    </h2>
                    <div class="container">
                        <form method="POST" id="comment_form">
                            <div class="form-group">
                                <label for="comment_name" style="font-family: fantasy;">
                                    Enter Name: 
                                </label>
                                <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name">
                            </div>
                            <table class="form-group">
                                <tr>
                                    <td>
                                        <label for="comment_name" style="font-family: fantasy;">
                                            Enter your Comments: 
                                        </label>
                                    </td>
                                    <td>
                                        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" cols="50" rows="10"></textarea>
                                    </td>
                                <tr>
                            </table>
                            <div class="form-group">
                                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                            </div>
                        </form>
                        <span id="comment_message"></span>
                        <br />
                        <div id="display_comment"></div>
                    </div>
                </div>
            </div>
        </main>
        <center>
            <div id="footer">
                <p>&copy; 20XX-2023 All Rights are resevered.</p>
            </div>
        </center>
    </div>
</body>
</html>
<script>
$(document).ready(function(){
    $('#comment_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"add_comment.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(data){
                if(data.error != '')
                {
                    $('#comment_form')[0].reset();
                    $('#comment_message').html(data.error);
                    $('#comment_id').val('0');
                    load_comment();
                }
            }
        })
    });
    load_comment();
    function load_comment(){
        $.ajax({
            url:"fetch_comment.php",
            method:"POST",
            success:function(data){
                $('#display_comment').html(data);
            }
        })
    }
    $(document).on('click', '.reply', function(){
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_name').focus();
    });
});
</script>