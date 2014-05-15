<?php
class Zend_View_Helper_AdminMenu extends Zend_View_Helper_Abstract
{
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function adminMenu() {
		
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Menú de Administración</h1>";
		$html .= "<ul>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl(). "/book\">Administración de libros.</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/admin/setmails\">Configurar e-mail de contactos.</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/admin/changepassword\">Cambio de contrasena.</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"".$this->view->baseUrl()."/advertisement\">Anuncios.</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->url(
					array(
						'controller' => 'authentication',
						'action'     => 'logout'
					), 'default', true) ."\" >Salir</a>";
		$html .= "</li>";
		$html .= "</ul>";
		$html .= "</div>";
		return $html;
	}
}