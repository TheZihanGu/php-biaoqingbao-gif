var $$ = mdui.JQ;

$$('#like').on('click', function () {
  mdui.snackbar({
    message: 'Thanks！既然喜欢这个网站，那么就前往GitHub为此项目Star一下吧！'
  });
});