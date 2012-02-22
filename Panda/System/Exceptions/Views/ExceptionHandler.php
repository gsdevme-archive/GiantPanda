<!doctype html>
<html lang="en">
	<head>
		<style>
			body,html{
				background:#FAFAFA;
				padding:0;margin:0;
				font-family: Helvetica, Arial, sans-serif;
				font-weight:400;
				font-size:13px;
			}

			.error{
				background:#DEDEDE;
			}

			.error h1{
				font-size:14px;
				font-weight:400;
				background:#606B7C;
				line-height:42px;
				color:#FAFAFA;
				margin:0;
				padding:0 10px 5px 10px;
			}

			.error .code{
				width:100%;
				padding:20px 1%;
			}

			.error .code h3{
				margin:0;
				padding:0;
				line-height:12px;
				font-size:12px;
				color:#303030;
			}

			.error .code pre{
				display:block;
				width:96%;
				padding:1%;
				font-family: monospace;
				white-space: pre-wrap;
				background:#FFF;
			}

			

		</style>
	</head>

	<body>
		<?php if(isset($errors)) foreach($errors as $error): ?>
			<div class="error">
				<h1><strong><?php echo $error->class; ?>:</strong> <?php echo $error->message; ?></h1>

				<div class="code">
					<h3><?php echo $error->file; ?> [Line <?php echo number_format($error->line);?>]</h3>

					<pre><code>
<?php echo (isset($error->htmlFile)) ? $error->htmlFile : null; ?>
					</code></pre>
				</div>
			</div>
		<?php endforeach; ?>
	</body>
</html>