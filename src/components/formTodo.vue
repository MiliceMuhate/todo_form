<template>
  <q-page class="flex flex-center">
    <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
      <q-input v-model="tarefaType" label="Tipo de Tarefa" />
      <q-input v-model="tarefaId" type="number" label="ID da Tarefa" />
      <q-input v-model="descricao" type="textarea" label="Descrição" />

      <div class="q-pa-sm row q-col-gutter-md items-center">
        <q-btn label="Submit" type="submit" color="primary" />
        <q-btn label="Reset" type="reset" color="secondary" />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { useQuasar } from 'quasar'
import { ref } from 'vue'
import axios from 'axios'

export default {
  setup () {
    const $q = useQuasar()

    const tarefaType = ref('')
    const tarefaId = ref(null)
    const descricao = ref('')

    const onSubmit = async () => {
      try {
        await axios.post('/api/todos', {
          tarefa_type: tarefaType.value,
          tarefa_id: tarefaId.value,
          descricao: descricao.value
        })

        $q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Tarefa criada com sucesso!'
        })

        onReset()  // Reset form after successful submission
      } catch (error) {
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: 'Erro ao criar tarefa: ' + (error.response ? error.response.data.message : error.message)
        })
      }
    }

    const onReset = () => {
      tarefaType.value = ''
      tarefaId.value = null
      descricao.value = ''
    }

    return {
      tarefaType,
      tarefaId,
      descricao,
      onSubmit,
      onReset
    }
  }
}
</script>

<style>
</style>
