<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Link Affiliate Code Generator</title>
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery1.9.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="js/email.js"></script>
</head>

<body>
<div class="page-content">
  <div class="center-page-content">
    <div class="panel panel-default">
      <div class="panel-heading center-align"><strong>Link Affiliate Code Generator</strong></div>
      <div class="panel-body">
        <table width="100%" border="0">
          <tr>
            <td><div class="input-group"> <span class="input-group-addon">@</span>
                <input class="form-control" type="text" id="url" placeholder="URL">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button" onClick="generate_html()">Generate Html</button>
                </span> </div>
                <br/>
                <span id="url_pointer"></span>
                </td>
          </tr>
          <tr>
            <td><textarea name="textarea_pop" id="textarea_pop" ></textarea></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>