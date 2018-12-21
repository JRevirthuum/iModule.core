<?php
/**
 * 이 파일은 iModule 의 일부입니다. (https://www.imodules.io)
 *
 * 사이트를 구성할 수 없는 치명적인 에러가 발생할 경우 사이트 레이아웃 구성을 모두 취소하고 이 에러페이지를 출력한다.
 * 사이트 레이아웃을 구성할 수 있는 에러일 경우 사이트 템플릿의 에러메세지 템플릿이나 모듈 에러메세지 이용하여 에러메세지를 출력하게 된다.
 *
 * @file /includes/error.php
 * @author Arzz (arzz@arzz.com)
 * @license MIT License
 * @version 3.0.0
 * @modified 2018. 12. 21.
 * @see /classes/iModule.class.php -> printError()
 */
if (defined('__IM__') == false) exit;
?>
<section class="errorbox">
	<div>
		<div>
			<?php if ($type == 'LOGIN') { ?>
			<h1><i class="mi mi-key"></i> <?php echo $message; ?></h1>
			
			<div data-role="input">
				<input type="email" name="email" placeholder="<?php echo $this->getText('text/email'); ?>">
			</div>
			
			<div data-role="input">
				<input type="password" name="password" placeholder="<?php echo $this->getText('text/password'); ?>">
			</div>
			
			<button type="submit"><?php echo $this->getText('button/login'); ?></button>
			<?php } else { ?>
			<h1><i class="mi mi-attention-o"></i> ERROR</h1>
			
			<h2><?php echo $message; ?></h2>
			<?php if ($description) { ?><p><?php echo $description; ?></p><?php } ?>
			
			<?php if (defined('__IM_CONTAINER_POPUP__') == true) { ?>
			<button type="button" onclick="self.close();"><?php echo $this->getText('button/close'); ?></button>
			<?php } elseif ($link != null) { ?>
			<a href="<?php echo $link->url; ?>"><?php echo $link->text; ?></a>
			<?php }} ?>
		</div>
	</div>
</section>