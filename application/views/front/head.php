<!-- Basic Page Needs -->
<meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title>Techno Store - Home Page</title>

<meta name="author" content="CreativeLayers">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Boostrap style -->
<link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/front/stylesheets/bootstrap.min.css">

<!-- Theme style -->
<link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/front/stylesheets/style.css">

<!-- Reponsive -->
<link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/front/stylesheets/responsive.css">
<link rel="stylesheet" href="<?php echo public_url()?>/front/stylesheets/jquery-ui.css">

<link rel="shortcut icon" href="<?php echo public_url()?>/front/favicon/favicon.png">

<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/front/javascript/jquery-ui.js"></script>

<script type="text/javascript">
    $(function() {
        $( "#text_search" ).autocomplete({
            source: "<?php echo site_url('product/search/1')?>",
			appendTo: "#txtAllowSearch",
        });
    });
</script>