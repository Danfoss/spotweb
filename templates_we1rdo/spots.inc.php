<?php $getUrl = $tplHelper->getFilterParams(); ?>
			<div class="spots">
				<table class="spots">
					<tbody>
					<tr class="head"> 
						<th class='category'> <a href="?page=index&sortby=category<?php echo $getUrl;?>" title="Sorteren op Categorie">Cat.</a> </th> 
						<th class='title'> <a href="?page=index&sortby=title<?php echo $getUrl;?>" title="Sorteren op Titel">Titel</a> </th> 
                        <?php if ($settings['retrieve_comments']) {
                        	echo "<th class='comments'> </th>";
						} # if ?>
						<th class='genre'> Genre </th> 
						<th class='poster'> <a href="?page=index&sortby=poster<?php echo $getUrl;?>" title="Sorteren op Afzender">Afzender</a> </th> 
						<th class='date'> <a href="?page=index&sortby=stamp<?php echo $getUrl;?>" title="Sorteren op Datum">Datum</a> </th> 
<?php if ($settings['show_nzbbutton']) { ?>
						<th class='nzb'> NZB </th> 
<?php } ?>						
<?php if ($settings['nzbhandling']['action'] != 'disable') { ?>
						<th class='sabnzbd'> SAB </th> 
<?php } ?>						
					</tr>

<?php
	$count = 0;
	foreach($spots as $spot) {
		# fix the sabnzbdurl en searchurl
		$spot['sabnzbdurl'] = $tplHelper->makeSabnzbdUrl($spot);
		$spot['searchurl'] = $tplHelper->makeSearchUrl($spot);
		if ($tplHelper->newSinceLastVisit($spot)) {
			$newSpotClass = 'new';
		} else {
			$newSpotClass = '';
		} # else

		$subcatFilter =  SpotCategories::SubcatToFilter($spot['category'], $spot['subcata']);
		
		$count++;
		

		echo "\t\t\t\t\t\t\t";
		echo "<tr class='" . $tplHelper->cat2color($spot) . ' ' . ($count % 2 ? "even" : "odd") . "'>" . 
			 "<td class='category'><a href='?search[tree]=" . $subcatFilter . "' title='Ga naar de categorie \"" . SpotCategories::Cat2ShortDesc($spot['category'], $spot['subcata']) . "\"'>" . SpotCategories::Cat2ShortDesc($spot['category'], $spot['subcata']) . "</a></td>" .
			 "<td class='title " . $newSpotClass . "'><a href='?page=getspot&amp;messageid=" . $spot['messageid'] . "' title='" . $spot['title'] . "' class='spotlink'>" . $spot['title'] . "</a></td>";
		
		if ($settings['retrieve_comments']) {
			echo "<td class='comments'><a href='?page=getspot&amp;messageid=" . $spot['messageid'] . "#comments' title='" . $tplHelper->getCommentCount($spot) . " comments bij \"" . $spot['title'] . "\"' class='spotlink'>" . $tplHelper->getCommentCount($spot) . "</a></td>";
		} # if
		
		echo "<td>" . SpotCategories::Cat2Desc($spot['category'], $spot['subcat' . SpotCategories::SubcatNumberFromHeadcat($spot['category'])]) . "</td>" .
			 "<td>" . $spot['poster'] . "</td>" .
			 "<td>" . $tplHelper->formatDate($spot['stamp'], 'spotlist') . "</td>";
			 

		# only display the NZB button from 24 nov or later
		if ($spot['stamp'] > 1290578400 ) {
			if ($settings['show_nzbbutton']) {
				echo "<td><a href='?page=getnzb&amp;messageid=" . $spot['messageid'] . "' title ='Download NZB' class='nzb'>NZB";
				
				if ($tplHelper->hasBeenDownloaded($spot)) {
					echo '*';
				} # if
				
				echo "</a></td>";
			} # if

			# display the sabnzbd button
			if (!empty($spot['sabnzbdurl'])) {
				echo "<td><a class='sabnzbd-button' target='_blank' href='" . $spot['sabnzbdurl'] . "' title='Add NZB to SabNZBd queue'><img height='16' width='16' class='sabnzbd-button' src='images/download-small.png'></a></td>";
			} # if
		} else {
			if ($settings['show_nzbbutton']) {
				echo "<td> &nbsp; </td>";
			} # if

			# display the sabnzbd button
			if (!empty($spot['sabnzbdurl'])) {
				echo "<td> &nbsp; </td>";
			} # if
		} # else
		
		
		echo "</tr>\r\n";
	}
?>
					<tr class="nav">
						<td colspan="4" style='text-align: left;'><?php if ($prevPage >= 0) { ?> <a href="?direction=prev&amp;page=<?php echo $prevPage . $getUrl;?>">< Vorige</a><?php }?></td>
						<td colspan="4" style='text-align: right;'><?php if ($nextPage > 0) { ?> <a href="?direction=next&amp;page=<?php echo $nextPage . $getUrl;?>">Volgende ></a><?php }?></td>
					</tr>

				</tbody>
			</table>
			
		</div>

		<div class="clear"></div>
		
