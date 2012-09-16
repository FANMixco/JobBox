<h2><?php echo $this->lang->line('txt_current_jobs').': '.count($jobs); ?></h2>
<br/><br/>
<h2><?php echo $this->lang->line('txt_app_jobs'); ?></h2>
<?php
echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_apps'),$apps,array('Position_Name','total_applications'),array(NULL,NULL,NULL,$this->lang->line('txt_actions')),
	'applications',
	array('fields' => array('icon view',$this->lang->line('txt_view'),'applications/view','idJob'), 'conditions' => array()
	));
?>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
	$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '<?php echo $this->lang->line('txt_report_1') ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: '<?php echo $this->lang->line('txt_report_1') ?>',
                data: [
					<?php 
						$first=true;
						foreach($jPerArea as $job):							
							if ($first):
								echo "{name:'".$job['Job_Area']."', y:".$job['total'].",sliced:true,selected:true},";
								$first=false;
							else:
								echo "['".$job['Job_Area']."', ".$job['total']."],";
							endif;
						endforeach;
					?>
					
                    /*['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]*/
                ]
            }]
		});
    });   
        
});

</script>