<script src="<?php echo base_url();?>lib/markitup/jquery.markitup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/sets/html/style.css" />

<script>
var myHtmlSettings = {
	    nameSpace:       "html", // Useful to prevent multi-instances CSS conflict
	    previewInWindow: 'width=600, height=400, resizable=yes, scrollbars=yes',
	    onShiftEnter:    {keepDefault:false, replaceWith:'<br />\n'},
	    onCtrlEnter:     {keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},
	    onTab:           {keepDefault:false, openWith:'     '},
	    markupSet:  [
	        {name:'Heading 1', key:'1', openWith:'<h1(!( class="[![Class]!]")!)>', closeWith:'</h1>', placeHolder:'Your title here...' },
	        {name:'Heading 2', key:'2', openWith:'<h2(!( class="[![Class]!]")!)>', closeWith:'</h2>', placeHolder:'Your title here...' },
	        {name:'Heading 3', key:'3', openWith:'<h3(!( class="[![Class]!]")!)>', closeWith:'</h3>', placeHolder:'Your title here...' },
	        {name:'Heading 4', key:'4', openWith:'<h4(!( class="[![Class]!]")!)>', closeWith:'</h4>', placeHolder:'Your title here...' },
	        {name:'Heading 5', key:'5', openWith:'<h5(!( class="[![Class]!]")!)>', closeWith:'</h5>', placeHolder:'Your title here...' },
	        {name:'Heading 6', key:'6', openWith:'<h6(!( class="[![Class]!]")!)>', closeWith:'</h6>', placeHolder:'Your title here...' },
	        {name:'Paragraph', openWith:'<p(!( class="[![Class]!]")!)>', closeWith:'</p>'  },
	        {separator:'---------------' },
	        {name:'Bold', key:'B', openWith:'<strong>', closeWith:'</strong>' },
	        {name:'Italic', key:'I', openWith:'<em>', closeWith:'</em>'  },
	        {name:'Stroke through', key:'S', openWith:'<del>', closeWith:'</del>' },
	        {separator:'---------------' },
	        {name:'Ul', openWith:'<ul>\n', closeWith:'</ul>\n' },
	        {name:'Ol', openWith:'<ol>\n', closeWith:'</ol>\n' },
	        {name:'Li', openWith:'<li>', closeWith:'</li>' },
	        {separator:'---------------' },
	        {name:'Picture', key:'P', replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />' },
	        {name:'Link', key:'L', openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith:'</a>', placeHolder:'Your text to link...' },
	        {separator:'---------------' },
	        {name:'Clean', replaceWith:function(h) { return h.selection.replace(/<(.*?)>/g, "") } },
	        {name:'Preview', call:'preview', className:'preview' }
	    ]
	};

// mIu nameSpace to avoid conflict.
miu = {
    markdownTitle: function(markItUp, char) {
        heading = '';
        n = $.trim(markItUp.selection||markItUp.placeHolder).length;
        for(i = 0; i < n; i++) {
            heading += char;
        }
        return '\n'+heading+'\n';
    }
}
</script>
<script language="javascript">
$(document).ready(function()	{
    $('#markItUp').markItUp(myHtmlSettings);
});
</script>
<div class="container-fluid">
	<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll">
		<textarea id="markItUp" cols="80" rows="15">
</textarea>


	</div>
</div>
