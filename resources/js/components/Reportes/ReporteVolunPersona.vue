<template>
  <div>
    <div>
      <div class="opciones">
        <input type="button" class="btn btn-success" @click="cargar25()" value="25 últimos" />
        <input type="button" class="btn btn-success" @click="cargar50()" value="50 últimos" />
        <input type="button" class="btn btn-success" @click="cargar75()" value="75 últimos" />
        <input type="button" class="btn btn-success" @click="cargar100()" value="100 últimos" />
        <input type="button" class="btn btn-success" @click="cargarTodos()" value="Todos" />
      </div>
    </div>
  </div>
</template>
<script>
import jsPDF from 'jspdf'
import 'jspdf-autotable'

export default {
  data() {
    return {
      filtroArray: {},
      todosArray: {},
      fechaActual: "",
    };
  },
  methods: {
    exportPDF() {
      var vm = this;

      var columns = [
        { title: "DNI Participante", dataKey: "identificacionPersona" },
        { title: "Lugar Procedencia", dataKey: "lugar" },
        { title: "Id Voluntario", dataKey: "voluntariado_id" },
        { title: "Cantidad Actividades", dataKey: "cantidad" },
      ];
      var doc = new jsPDF("p", "pt", "a4");

      var img = new Image(); //this mount a variable to img
      img.src = "/images/MarcaAgua.jpeg"; //asign the src to the img variable
      //estilo para el nombre sendero los matapalos
      doc.setDrawColor("#d9d9da");
      doc.setFillColor("#d9d9da");
      doc.rect(40, 5, 520, 43, "FD"); //Fill and Border
      doc.text("Sendero los matapalos", 42, 30);
      doc.setFontSize(15);
      //Estilo para el titulo del reporte
      doc.setFillColor("#3bd99f");
      doc.setDrawColor("#3bd99f");
      doc.setTextColor("#354942");
      doc.rect(45, 52, 430, 25, "FD"); //Fill and Border rect(posicion x, posicion y, tamaño x, tamaño y)
      doc.text(" Reporte de voluntarios participantes", 50, 68);
      //Estilo para la fecha
      doc.setFillColor("#d9d9da");
      doc.setDrawColor("#d9d9da");
       doc.setTextColor("#354942");
      doc.rect(430, 52, 120, 25, "FD"); //Fill and Border
      doc.text("Fecha:" + this.fechaActual, 432, 68);
      doc.addImage(img, "png", 470, 10, 74, 35);
      doc.autoTable(columns, vm.filtroArray.data, {
        theme: "grid",
        tableLineColor: "#3bd99f",
        tableLineWidth: 0.1,
        margin: { top: 80 },
         styles: {
          fillStyle: "DF",
          halign: "center",
          valign: "middle",
          columnWidth: "auto",
          overflow: "linebreak",
        },
        headerStyles: {
          fillColor: "#3bd99f",
          fontSize: 12,
        },
        bodyStyles: {
          fillColor: [216, 216, 216],
          textColor: 50,
        },
        alternateRowStyles: {
          fillColor: [250, 250, 250],
        },
      });
      doc.save("Reporte Voluntario Participantes.pdf");
    },
    cargar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReporteVoluntariosParti/todo")
          .then(({ data }) => (this.todosArray = data.data));
      }
    },
    cargarTodos(){
        this.filtroArray.data = this.todosArray;
         this.exportPDF();
    },
    cargar10(){
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReporteVoluntariosParti/solo10")
          .then(({ data }) => (this.filtroArray = data.data));
      }

    },
    cargar25(){
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReporteVoluntariosParti/solo25")
          .then(({ data }) => (this.filtroArray = data.data));
          this.exportPDF();
      }
    },
    cargar50(){
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReporteVoluntariosParti/solo50")
          .then(({ data }) => (this.filtroArray = data.data));
           this.exportPDF();
      }
    },
    cargar75(){
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReporteVoluntariosParti/solo75")
          .then(({ data }) => (this.filtroArray = data.data));
           this.exportPDF();
      }
    },
    cargar100(){
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReporteVoluntariosParti/solo100")
          .then(({ data }) => (this.filtroArray = data.data));
           this.exportPDF();
      }
    }
  },

  created() {
    this.$Progress.start();
    this.cargar();
    this.cargar10();
    this.$Progress.finish();
    window.onload = this.set;
  },
  computed: {
    set: function () {
      var today = new Date();
      var strDate = "d-m-Y"
        .replace("Y", today.getFullYear())
        .replace("m", today.getMonth() + 1)
        .replace("d", today.getDate());
      this.fechaActual = strDate;
    },
  },
};
</script>

<style scoped>
.opciones{
  margin: 5px;
  padding: 5px;
  text-align: center;
}
@media only screen and (min-width: 192px) and (max-width: 1192px) {
  .opciones{
    margin: 5px;
    padding: 5px;
    text-align: center;
    display: flex;
    flex-direction: column;

    gap: 10px;
  }
}
</style>
