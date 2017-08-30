@extends('layouts.app')

@section('content')



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

   <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')


                    <!-- 수정 -->
                    @if($task)

                            <form action="" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                <div class="form-group">
                                    <label for="task-name" class="col-sm-3 control-label">Task</label>

                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                                    </div>

                                </div>

                                <div class="form-group" id="addBtn">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-btn fa-plus"></i>Edit Task
                                        </button>
                                    </div>
                                </div>

                            </form>

                    @else

                    <!-- New Task Form -->
                    <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                                <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group" id="addBtn">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>

                    </form>
                    @endif
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $task->created_at }}</div>
                                        <div>{{ $task->name }}</div>
                                    </td>

                                    <!-- Task Delete Button -->
                                    <td>
                                        <form action="{{url('task/' . $task->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}


                                            {{--
                                            <button type="button" id="btnModify" onClick="modify('{{ $task->id }}','{{ $task->name }}')" class="btn btn-info">
                                                <i class="fa fa-btn fa-trash"></i>Modify
                                            </button>
                                            --}}
                                            <a href="{{ url('tasks/'.$task->id) }}" class="btn btn-info"><i class="fa fa-btn fa-trash"></i>Modify</a>
                                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>



@endsection