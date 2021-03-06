				<div class="filter">
					<h4>Zoeken</h4>

					<form id="filterform" action="">
<?php
	$search = array_merge(array('type' => 'Titel', 'text' => '', 'tree' => '', 'unfiltered' => ''), $search);
?>
						<input type="hidden" id="search-tree" name="search[tree]" value="<?php echo $search['tree']; ?>"></input>
						<table class="filters">
							<tbody>
								<tr> 
									<td> <input type="radio" name="search[type]" value="Titel"  <?php echo $search['type'] == "Titel" ? 'checked="checked"' : "" ?>>Titel</input> </td>
									<td> <input type="radio" name="search[type]" value="Poster" <?php echo $search['type'] == "Poster" ? 'checked="checked"' : "" ?>>Afzender</input> </td>
									<td> <input type="radio" name="search[type]" value="Tag"	<?php echo $search['type'] == "Tag" ? 'checked="checked"' : "" ?>>Tag</input> </td>
								</tr>
								
								<tr>
									<td colspan="3"><input class='searchbox' type="text" name="search[text]" value="<?php echo htmlspecialchars($search['text']); ?>"></input></td>
								</tr>

								<tr> 
									<td colspan='3'> <input type="checkbox" name="search[unfiltered]" value="true"  <?php echo $search['unfiltered'] == "true" ? 'checked="checked"' : "" ?>>Vergeet filters voor zoekopdracht</input> </td>
								</tr>
							</tbody>
						</table>

                        <div id="tree"> 
                            <ul>
                            </ul>
                        </div>
						
						<input type='submit' class="filtersubmit" value='Zoek en filter'></input>
					</form>

<h4>Filters</h4>
                    
                    <ul class="filterlist">
<?php
    foreach($filters as $filter) {
?>
                        <li<?php if($filter[2]) { echo " class='". $tplHelper->filter2cat($filter[2]) ."'"; } ?>> <a class="filter <?php echo $filter[3]; ?>" href="?search[tree]=<?php echo $filter[2];?>"><img src='<?php echo $filter[1]; ?>'><?php echo $filter[0]; ?></a>
<?php
        if (!empty($filter[4])) {
            echo "\t\t\t\t\t\t\t<ul class='filterlist subfilterlist'>\r\n";
            foreach($filter[4] as $subFilter) {
				$strFilter = '?search[tree]=' . $subFilter[2];
?>
            			<li> <a class="filter <?php echo $subFilter[3];?>" href="<?php echo $strFilter;?>"><img src='<?php echo $subFilter[1]; ?>'><?php echo $subFilter[0]; ?></a>
<?php
				if (!empty($subFilter[4])) {
					echo "\t\t\t\t\t\t\t<ul class='filterlist subfilterlist'>\r\n";
					foreach($subFilter[4] as $sub2Filter) {
						$strFilter = '';
		?>
							<li> <a class="filter <?php echo $sub2Filter[3];?>" href="<?php echo $strFilter;?>"><img src='<?php echo $sub2Filter[1]; ?>'><?php echo $sub2Filter[0]; ?></a>
		<?php
					} # foreach 
					echo "\t\t\t\t\t\t\t</ul>\r\n";
				} # is_array
			
			} # foreach 
            echo "\t\t\t\t\t\t\t</ul>\r\n";
        } # is_array
    } # foreach
?>
                    </ul>

					<h4>Maintenance</h4>
					<ul class="filterlist maintenancebox">
						<li class="info"> Laatste update: <?php echo $tplHelper->formatDate($lastupdate, 'lastupdate'); ?> </li>
<?php
	if ($settings['show_updatebutton']) {
?>
						<li> <a href="retrieve.php?output=xml" id="updatespotsbtn" class="updatespotsbtn">Update Spots</a></li>
<?php
	}
?>
<?php
	if ($settings['keep_downloadlist']) {
?>
						<li> <a href="?page=erasedls" id="removedllistbtn" class="erasedlsbtn">Remove history of downloads</a></li>
<?php
	}
?>
						<li> <a href="?page=markallasread" id="markallasreadbtn" class="markallasreadbtn">Mark all as read</a></li>
					</ul>

				</div>
