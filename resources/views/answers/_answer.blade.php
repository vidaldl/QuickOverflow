<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        <vote :model="{{ $answer }}" name="answer"></vote>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" id="" rows="10" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary" type="submit" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" type="button" @click="cancel">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update', $answer)
                                <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan
                            @can('delete', $answer)
                                <button @click="destroy" class="btn btn-sm btn-outline-danger" >Delete</button>
                                <form class="form-delete" action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4">

                    </div>
                    <div class="col-4">
                        <user-info :model="{{$answer}}" label="Answered"></user-info>
                    </div>
                </div>
            </div>

        </div>
    </div>
</answer>

