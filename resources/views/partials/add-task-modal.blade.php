<div class="modal fade" id="taskAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{__("Add new task")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="{{url('/projects/'.$project->id.'/task')}}">
          @csrf
          <div class="col-md-12">
              <label for="task">Enter a task</label>
              <input id="task" type="task" class="form-control @error('task') is-invalid @enderror" name="task" value="{{ old('task') }}" required autocomplete="task" autofocus>

              @error('task')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <button type="submit" class="mt-3 ml-2 btn btn-primary">Add Task</button>
        </form>
      </div>
    </div>
  </div>
</div>