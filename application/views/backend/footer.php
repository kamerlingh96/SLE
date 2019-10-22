<!-- Footer -->
<footer class="main">
	&copy; 2018 <strong> <?php echo $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description; ?> | Versión 1</strong>
    Desarrollado por
	<a href="https://web.facebook.com/artbot.mx/"
    	target="_blank">ARTBOT Robótica</a>
</footer>
