<div class="panel panel-default" v-cloak>
  <div class="panel-heading">
    <a href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <span>Ticket: #@{{ticket.ticket_id}}</span>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-4">
        <!-- User -->
        <div class="form-group">
          <label class="col-md-4 control-label">User</label>
          <div class="col-md-6">@{{ usr.name }}</div>
        </div>

        <!-- Category -->
        <div class="form-group">
          <label class="col-md-4 control-label">Category</label>
          <div class="col-md-6"> @{{ cat.name }}</div>
        </div>

        <!-- Status -->
        <div class="form-group">
            <label class="col-md-4 control-label">Status</label>
            <div class="col-md-6">@{{ stat.name }}</div>
        </div>

        <!-- Priority -->
        <div class="form-group">
            <label class="col-md-4 control-label">Priority</label>
            <div class="col-md-6">@{{ pri.name }}</div>
        </div>
      </div>
      <div class="col-md-8">
        <!-- Title -->
        <div class="form-group">
          <label class="col-md-2 control-label">Title</label>
          <div class="col-md-10">@{{ newTicket.title }}</div>
        </div>

        <!-- Ticket -->
        <div class="form-group">
          <label class="col-md-2 control-label">Description</label>
          <div class="col-md-10">
            <textarea class="form-control" name="message"  v-model="newTicket.message" rows="6"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      
    </div>
  </div>
</div>
