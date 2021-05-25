<?php
class PaginationCategory{
	
	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 5;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage 			=1;		// Trang hiện tại
	
	public function __construct($totalItems, $pagination){
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $pagination['totalItemsPerPage'];
		
		if($pagination['pageRange'] %2 == 0) $pagination['pageRange'] = $pagination['pageRange'] + 1;
		
		$this->pageRange			= $pagination['pageRange'];
		$this->currentPage			= $pagination['currentPage'];
		$this->totalPage			= ceil($totalItems/$pagination['totalItemsPerPage']);
	}
	
	public function showPagination($link = null){
		//link <a href="#?page=2">
		// $link = index.php?module=default&controller=category&action=index&page=
		// Pagination
		$paginationHTML = '';
		if($this->totalPage > 1){
			$start 	= '<span class="disabled">Start</span>';
			$prev 	= '<span class="disabled">Pre</span>';
			if($this->currentPage > 1){
				$start 	= '<span><a href="'.$link.'1">Start</a></span>';
				$prev 	= '<span><a href="'.$link.($this->currentPage-1).'">Previous</a></span>';
			}
		
			$next 	= '<span class="disabled">Next</span>';
			$end 	= '<span class="disabled">End</span>';
			if($this->currentPage < $this->totalPage){
				$next 	= '<span><a href="'.$link.($this->currentPage+1).'">Next</a></span>';
				$end 	= '<a href="'.$link.$this->totalPage.'">End</a>';
			}
		
			if($this->pageRange < $this->totalPage){
				if($this->currentPage == 1){
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				}else if($this->currentPage == $this->totalPage){
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				}else{
					$startPage		= $this->currentPage - ($this->pageRange-1)/2;
					$endPage		= $this->currentPage + ($this->pageRange-1)/2;
		
					if($startPage < 1){
						$endPage	= $endPage + 1;
						$startPage = 1;
					}
		
					if($endPage > $this->totalPage){
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			}else{
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			//$listPages = '<div class="button2-left"><div class="page">';
			$listPages = "";
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $this->currentPage) {
					$listPages .= '<span class="current">'.$i.'</span>';
				}else{
					$listPages .= '<a href="'.$link.$i.'">'.$i.'</a>';
				}
			}
			//$listPages .= '</div></div>';
			//$endPagination	= '<div class="limit">Page '.$this->currentPage.' of '.$this->totalPage.'</div>';
			$endPagination = "";
			$paginationHTML = '<div class="pagination">' . $start . $prev . $listPages . $next . $end . $endPagination . '</div>';
		}
		return $paginationHTML;
	}
}