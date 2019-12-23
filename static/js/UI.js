var UI = {
	// 动态加载模态框
	alert: function(obj){
		var title = (obj == undefined || obj.title == undefined)? '系统消息' : obj.title;
		var msg = (obj == undefined || obj.msg == undefined)? '' : obj.msg;
		var icon = (obj == undefined || obj.icon == undefined)? 'warm' : obj.icon;
		// <!-- 模态框引入 -->
		var html = '<div class="modal fade" id="UI_alert_sm" tabindex="-1" role="dialog">\
  <div class="modal-dialog modal-sm" role="document">\
    <div class="modal-content">\
      <div class="modal-header">\
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
        <h4 class="modal-title">'+title+'</h4>\
      </div>\
      <div class="modal-body">\
        <p><img src="/static/img/'+icon+'.png" style="width:26px;height:26px;margin-right: 10px;">'+msg+'</p>\
      </div>\
      <div class="modal-footer">\
        <button type="button" class="btn btn-primary" onclick="$(\'#UI_alert_sm\').modal(\'hide\');">确定</button>\
      </div>\
    </div><!-- /.modal-content -->\
  </div><!-- /.modal-dialog -->\
</div><!-- /.modal -->'
		
		// 追加模态框到body后面
		$('body').append(html);
		$('#UI_alert_sm').modal({backdrop: 'static'});
		$('#UI_alert_sm').modal('show');
		// 弹出并删除加入的方法
		$('#UI_alert_sm').on('hidden.bs.modal', function (e) {
			$('#UI_alert_sm').remove();
		})
	},


	// 加载页面方法
	open: function(obj){
		// <!-- 模态框引入 -->
		var title = (obj == undefined || obj.title == undefined)? '' : obj.title;
		var url = (obj == undefined || obj.url == undefined) ? '' : obj.url;
		var width = (obj == undefined || obj.width  == undefined) ? 400 : obj.width;
		var height = (obj == undefined || obj.height == undefined) ? 470 : obj.height;

		var html = '<div class="modal fade" id="UI_open_lg" tabindex="-1" role="dialog">\
  <div class="modal-dialog modal-lg" role="document">\
    <div class="modal-content">\
      <div class="modal-header">\
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
        <h4 class="modal-title">'+title+'</h4>\
      </div>\
      <div class="modal-body">\
   		  <iframe src="'+url+'" frameborder="0" style="width:100%; height:100%;">\
     </div>\
    </div><!-- /.modal-content -->\
  </div><!-- /.modal-dialog -->\
</div><!-- /.modal -->'
		
		// 追加模态框到body后面
		$('body').append(html);
		$('#UI_open_lg .modal-lg').css('width',width);
		$('#UI_open_lg .modal-body').css('height',height);
		$('#UI_open_lg').modal({backdrop: 'static'});
		$('#UI_open_lg').modal('show');
		// 弹出并删除加入的方法
		$('#UI_open_lg').on('hidden.bs.modal', function (e) {
			$('#UI_open_lg').remove();
		})
	}
}