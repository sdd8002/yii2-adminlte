<?php
use yii\helpers\Html;

/* @var $btn_name String */
/* @var $form_id String */
/* @var $confirm String */

?>

<?= Html::Button($btn_name, ['id' => 'btn_submit', 'class' => 'btn btn-success', 'onclick'=>'onSubmitConfirm()' ]) ?>

<script type="text/javascript">
	var layerSubmitIndex;
	function onSubmitConfirm(){
		var form_id = "#<?=$form_id?>";
		layerSubmitIndex = layer.confirm('<?=$confirm?>', {
		  btn: ['提交','放弃'], skin: 'layui-layer-molv'
		}, function(){
			$("#submit_type").val('submit');
			$(form_id+' .nav-tabs li').removeClass('active').eq(0).addClass('active');
			$(form_id+' .tab-content .tab-pane').removeClass('active').eq(0).addClass('active');
			try{
				$(form_id).submit();
				layer.close(layerSubmitIndex);
				setTimeout(function () {
					var error = $(".has-error");
					if(error.length>0){
						var block = $(error[0]).find(".help-block");
						var message = $(block[0]).html();
						bolevine.alert({flag: 4, message: message});
					}
				}, 500);
			}
			catch($er){
				var message = '提交出现异常,请联系管理员';
				bolevine.alert({message: message});
			}
		}, function(){
			var message = '提交已放弃';
			bolevine.alert({message: message});
		});
	}

</script>