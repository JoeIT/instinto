<?php
class Zend_View_Helper_TopicList extends Zend_View_Helper_Abstract {
	public $view;

	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function topicList() {

		$html = "<div class=\"content_left_section\" name=\"topic-list\">";
		$html .= "<h1>Temáticas Destacadas</h1>";
		$html .= "<ul>";
		$mainTopics = array("Historia", "Literatura", "Economía", "Cultura", "Política", "Medio ambiente", "Agricultura", "Recursos naturales", "Educación", "Derecho", "Antropología", "Sociología", "Lingüística", "Comunicación Social", "Estadísticas", "Ecología", "Etnografía", "Ciencia y tecnología", "Artes", "Arqueología", "Ciencias Sociales", "Arquitectura", "Etnología", "Artesanía", "Música", "Folklore", "Psicología", "Teología", "Publicaciones periódicas", );
		foreach ($mainTopics as $topicName) {
			$html .= "<li>";
			$html .= "<a href=\"#\" onclick=\"submitTopicsForm(this);\" name=\"" . $topicName . "\">";
			$html .= $topicName;
			$html .= "</a>";
			$html .= "</li>";
		}
		$html .= "</ul>";
		$html .= "</div>";
		return $html;
	}
}