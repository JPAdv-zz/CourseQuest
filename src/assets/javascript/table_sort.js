/*
  This is the function that sorts the table.
  @Author: Jose Padilla
 */
$(document).ready(function() {
		// Calls the tablesorter plugin.
		$("#courseTable").tablesorter({
		// Sort by # of weeks.
		sortList: [[4,1]],
		// Do not sort by images (both courses and professors)!
		headers: { 0:{sorter: false}, 6:{sorter:false}}
	});
});
