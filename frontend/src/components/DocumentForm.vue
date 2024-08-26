<template>
  <div>
    <form @submit.prevent="generateDocument">
      <div>
        <label for="title">Название документа</label>
        <input type="text" id="title" v-model="title" required />
      </div>
      <div>
        <label for="date">Дата создания</label>
        <input type="date" id="date" v-model="date" required />
      </div>
      <button type="submit">Сгенерировать</button>
    </form>
    <div v-if="fileUrl">
      <p>Документ успешно сгенерирован. <a :href="fileUrl" download>Скачать документ</a></p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: '',
      date: new Date().toISOString().split('T')[0], // Устанавливает сегодняшнюю дату по умолчанию
      fileUrl: ''
    }
  },
  methods: {
    async generateDocument() {
      try {
        const response = await fetch('/generate-document', {
          // <-- Здесь используется относительный путь
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ title: this.title, date: this.date })
        })

        if (!response.ok) {
          throw new Error('Ошибка при генерации документа')
        }

        const data = await response.json()
        this.fileUrl = data.file_url
      } catch (error) {
        console.error(error)
        alert('Произошла ошибка при генерации документа.')
      }
    }
  }
}
</script>

<style scoped>
form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

div {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type='text'],
input[type='date'] {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

button {
  padding: 10px 15px;
  background-color: #42b983;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #369f7c;
}
</style>
