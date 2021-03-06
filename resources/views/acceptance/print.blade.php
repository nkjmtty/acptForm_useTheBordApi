<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
@font-face {
	font-family: yg;
	font-style: normal;
	font-weight: normal;
	src: url('{{ storage_path('fonts/YuGothM.ttf') }}') format('truetype');
}
@font-face {
	font-family: yg;
	font-style: bold;
	font-weight: bold;
	src: url('{{ storage_path('fonts/YuGothB.ttf') }}') format('truetype');
}
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
margin: 0;
padding: 0;
border: 0;
font-size: 100%;
font: inherit;
vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
display: block;
}
body {
line-height: 1;
}
ol, ul {
list-style: none;
}
blockquote, q {
quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
content: '';
content: none;
}
table {
border-collapse: collapse;
border-spacing: 0;
}
body {
	font-family: yg !important;
	font-size: 12px;
}
.my-preview {
}
.my-preview .my-preview_inner {
	padding: 1em;
}
.my-preview .my-preview_title {
	font-size: 180%;
	letter-spacing: 0.4em;
	text-align: center;
	margin-top: 1em;
	margin-bottom: 1em;
}
.my-preview .my-preview_subtitle {
	font-size: 120%;
	margin-bottom: 1em;
}
.my-preview .my-preview_text {
	margin-bottom: 1em;
}

.my-preview table.my-preview-layout {
	width: 100%;
}
.my-preview table.my-preview-layout > tbody > tr > th ,
.my-preview table.my-preview-layout > tbody > tr > td {
	box-sizing: border-box;
	vertical-align: top;
}
.my-preview table.my-preview-layout .my-preview-layout_l {
	width: 65%;
	padding-right: 10%;
}
.my-preview table.my-preview-layout .my-preview-layout_r {
	width: 35%;
}

.my-preview table.my-preview-data {
	width: 100%;
	margin-bottom: 1em;
}
.my-preview table.my-preview-data .my-preview-data_w30p {
	width: 30%;
}

.my-preview table.my-preview-data th ,
.my-preview table.my-preview-data td {
	padding: 0.2em 0.5em;
}
.my-preview table.my-preview-data-label {
}
.my-preview table.my-preview-data-label th {
	background-color: gray;
	color: white;
	text-align: center;
}
.my-preview table.my-preview-data-outline {
}
.my-preview table.my-preview-data-outline th {
	background-color: gray;
	color: white;
	text-align: center;
}
.my-preview table.my-preview-data-total {
	font-size: 120%;
	border: solid 1px gray;
}
.my-preview table.my-preview-data-total th ,
.my-preview table.my-preview-data-total td {
	border: solid 1px gray;
	text-align: center;
}


.my-preview table.my-preview-data-total th {
	background-color: gray;
	color: white;
}
.my-preview table.my-preview-data-total td {
	padding-top: 0.5em;
	padding-bottom: 0.5em;
}


.my-preview table.my-preview-data-items {
}
.my-preview table.my-preview-data-items thead th ,
.my-preview table.my-preview-data-items thead td ,
.my-preview table.my-preview-data-items tfoot th {
	background-color: gray;
	color: white;
	text-align: center;
}

.my-preview table.my-preview-data-items th ,
.my-preview table.my-preview-data-items td {
	border: solid 1px gray;
}
.my-preview table.my-preview-data-items tbody td {
	text-align: center;
}
.my-preview table.my-preview-data-items tbody th[colspan] {
	background-color: lightgray;
}
.my-preview table.my-preview-data-items tbody td[colspan] {
	text-align: left;
}
.my-preview table.my-preview-data .my-preview-data_num {
	text-align: right;
}
.my-preview table.my-preview-data .my-preview-data_blank {
	background-color: transparent;
	border-style: none;
}
.my-preview table.my-preview-data-etc {
}
.my-preview table.my-preview-data-etc th ,
.my-preview table.my-preview-data-etc td {
	border: solid 1px gray;
}
.my-preview table.my-preview-data-etc th {
	color: white;
	background-color: gray;
}
.my-preview table.my-preview-data-etc td {
    min-height: 3em;
    vertical-align: top;
}
.my-preview .my-preview-dummy {
	color: lightgray;
}
</style>
</head>
<body>
@include('acceptance/pdf')
</body>
</html>
