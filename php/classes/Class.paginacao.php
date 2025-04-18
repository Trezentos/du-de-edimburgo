<?php
 
class Paginator{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $high;
	var $limit;
	var $return;
	var $default_ipp = 25;
	var $querystring;
	var $link;

	var $next;
	var $prev;

 
	function __construct()
	{
		global $_lang;
		global $lang;

		$this->next = $_lang[$lang]['proximo'];
		$this->prev = $_lang[$lang]['anterior'];
		$this->ir_para_pag = $_lang[$lang]['ir_para_pagina'];

		$this->current_page = 1;
		$this->mid_range = 7;
		$this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp']:$this->default_ipp;
		$this->link = $_SERVER['PHP_SELF'];
	}
 
	function paginate($pag=false)
	{
		if($_GET['ipp'] == 'Todos')
		{
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (int) ($pag?$pag:$_GET['page']); // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;
 
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']);
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "page" AND $keyval[0] != "ipp") $this->querystring .= "&" . $arg;
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "page" And $key != "ipp") $this->querystring .= "&$key=$val";
			}
		}

		if($this->num_pages > 1)
		{
			$this->return = ($this->current_page != 1) ? "<span class=\"anterior\"><a class=\"paginate\" href=\"$this->link?page=$prev_page&ipp=$this->items_per_page$this->querystring\">".$this->prev."</a></span> ":"<span class=\"anterior inactive\" href=\"#\">".$this->prev."</span>";
 
			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);
 
			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);
 
			$this->return .= "<ul>";

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through Todos pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $_GET['page'] != 'Todos') ? "<li class=\"active\"><a title=\" ".$this->ir_para_pag." $i de $this->num_pages\" href=\"#\">$i</a></li> ":"<li><a class=\"paginate\" title=\" ".$this->ir_para_pag." $i de $this->num_pages\" href=\"$this->link?page=$i&ipp=$this->items_per_page$this->querystring\">$i</a></li> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}

			$this->return .= "</ul>";

			$this->return .= (($this->current_page != $this->num_pages) And ($_GET['page'] != 'Todos')) ? "<span class=\"proxima\"><a class=\"paginate\" href=\"$this->link?page=$next_page&ipp=$this->items_per_page$this->querystring\">".$this->next."</a></span>\n":"<span class=\"proxima inactive\" href=\"#\">".$this->next."</span>\n";
		}
		else
		{
			$this->return .= "<ul>";

			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<li class=\"active\"><a href=\"#\">$i</a></li> ":"<li><a class=\"paginate\" href=\"$this->link?page=$i&ipp=$this->items_per_page$this->querystring\">$i</a></li> ";
			}

			$this->return .= "</ul>";
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($_GET['ipp'] == 'Todos') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($_GET['ipp'] == 'Todos') ? "":" LIMIT $this->low,$this->items_per_page";
	}
 
	function display_items_per_page()
	{
		$items = '';
		$ipp_array = array(10,25,50,100,'Todos');
		foreach($ipp_array as $ipp_opt)    $items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
		return "<span class=\"paginate\">Items per page:</span><select class=\"paginate\" onchange=\"window.location='$this->link?page=1&ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
	}
 
	function display_jump_menu()
	{
		for($i=1;$i<=$this->num_pages;$i++)
		{
			$option .= ($i==$this->current_page) ? "<option value=\"$i\" selected>$i</option>\n":"<option value=\"$i\">$i</option>\n";
		}
		return "<span class=\"paginate\">Page:</span><select class=\"paginate\" onchange=\"window.location='$this->link?page='+this[this.selectedIndex].value+'&ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n";
	}
 
	function display_pages()
	{
		return $this->return;
	}
}