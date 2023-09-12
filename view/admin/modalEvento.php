<?php
$m=''; //for error messages
$id_event=''; //id event created 
$link_event; 
if(isset($_POST['agendar'])){
    

    date_default_timezone_set('America/Bogota');
    include_once 'google-api-php-client/vendor/autoload.php';

    //configurar variable de entorno / set enviroment variable
    putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->setScopes(['https://www.googleapis.com/auth/calendar']);

    //define id calendario
    $id_calendar='7d24de5bad89ed26c5b1a6b0d8c5d4be969d17892a3eadb33481397ade92bda3@group.calendar.google.com';//
    
   
      
    $datetime_start = new DateTime($_POST['date_start']);
    $time_start = new DateTime($_POST['time_start']);
    $time_end = new DateTime($_POST['timefinally_start']);
    
    // //aumentamos una hora a la hora inicial/ add 1 hour to start date
    // $time_end = $datetime_end->add(new DateInterval('PT1H'));
    
    //datetime must be format RFC3339
    $time_start =$time_start->format(\DateTime::RFC3339);
    $time_end=$time_end->format(\DateTime::RFC3339);

    
    $nombre=(isset($_POST['titulo']))?$_POST['titulo']:' xyz ';
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:' xyz ';
    // $asesor=$_POST['asesor'];
    try{
        
        //instanciamos el servicio
    	 $calendarService = new Google_Service_Calendar($client);
      
        
      
        //parámetros para buscar eventos en el rango de las fechas del nuevo evento
        //params to search events in the given dates
        $optParams = array(
            'orderBy' => 'startTime',
            'maxResults' => 20,
            'singleEvents' => TRUE,
            'timeMin' => $time_start,
            'timeMax' => $time_end,
        );

        //obtener eventos 
        $events=$calendarService->events->listEvents($id_calendar,$optParams);
        
        //obtener número de eventos / get how many events exists in the given dates
        $cont_events=count($events->getItems());
     
        //crear evento si no hay eventos / create event only if there is no event in the given dates
        if($cont_events == 0){

            $event = new Google_Service_Calendar_Event();
            $event->setSummary($nombre);
            $event->setDescription($descripcion);

            //fecha inicio
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($time_start);
            $event->setStart($start);

            //fecha fin
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($time_end);
            $event->setEnd($end);

            // $attendees = array();
 
            // // Agregar los Participantes
            // $attendee = new Google_Service_Calendar_EventAttendee();
            // $attendee->setEmail($asesor);
            // $attendees[] = $attendee;
            
            // $event->attendees = $attendees;

          
            $createdEvent = $calendarService->events->insert($id_calendar, $event);
            $id_event= $createdEvent->getId();
            $link_event= $createdEvent->gethtmlLink();
            
        }else{
            $m = "Hay ".$cont_events." eventos en ese rango de fechas";
        }


    }catch(Google_Service_Exception $gs){
     
      $m = json_decode($gs->getMessage());
      $m= $m->error->message;

    }catch(Exception $e){
        $m = $e->getMessage();
      
    }
}
?>


<!-- modal para adicionar un nuevo evento en google calendar-->
<div class="modal fade" id="nEvento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="event-title">Nuevo Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <?php 
                    if(isset($_POST['agendar'])){
                    if($m!=''){
                    ?>
                    <label class="control-form">Error :<?php echo $m;   ?></label>
                    <?php
                    }
                    elseif($id_event!=''){
                        ?>
                        <label class="control-form">EVENTO CREADO CON EXITO</label><br>
                        <label class="control-form">ID EVENTO :<?php echo $id_event;   ?></label><br>
                        <a href="<?php  echo $link_event;  ?>">LINK</a>
                        <?php
                    }
                    ?><br>
                    <button type="button" class="btn btn-primary btn-block" onclick="reload();">BACK</button>
                    <?php
                    }
                    else{
                    ?>
                    <div class="form-group">

                    <div class="row">
                    <div class="col-sm-12">
                        <label>Titulo</label>
                            <div class="form-group">
                                <div class="input-group ">
                                    <input type="text" class="form-control "  name="titulo" placeholder="Ingrese el titulo" autocomplete="off" />
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <label>Descripcion</label>
                            <div class="form-group">
                                <div class="input-group ">
                                    <input type="text" class="form-control "  name="descripcion" placeholder="Ingrese la descripcion" autocomplete="off" />
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                        <label>Fecha</label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_start"/>
                            </div>
                        </div>
                    
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                        <label>Hora</label>
                            <div class="form-group">
                                <input type="time" class="form-control" name="time_start"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <label>Hora</label>
                            <div class="form-group">
                                <input type="time" class="form-control" name="timefinally_start"/>
                            </div>
                        </div>
                    
                    </div>
                    <!-- <div class="row">
                    <div class="col-sm-12">
                        <label>Asesor</label>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="email" class="form-control" name="asesor" placeholder="Enter your email" autocomplete="off" />

                        </div>
                        </div>
                    </div>
                    </div> -->

                    </div>
                    
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" name="agendar">Agregar </button>
            </div>
            <?php 
                }
            ?>
            </form>
        </div>
    </div>
</div>
<!-- fin del modal -->