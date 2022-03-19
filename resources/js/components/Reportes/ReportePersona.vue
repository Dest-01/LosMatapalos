<template>
  <div>
    <div>
      <div class="opciones">
        <input type="button" class="btn btn-success" value="25 últimos" />
        <input type="button" class="btn btn-success" value="50 últimos" />
        <input type="button" class="btn btn-success" value="75 últimos" />
        <input type="button" class="btn btn-success" value="100 últimos" />
        <input type="button" class="btn btn-success" value="Todos" />
        <input
          type="button"
          @click="exportPDF()"
          class="btn btn-danger"
          value="Descargar PDF"
        />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      personas: {},
      fechaActual: "",
    };
  },
  methods: {
    exportPDF() {
      var vm = this;
      var columns = [
        { title: "DNI", dataKey: "identificacion" },
        { title: "Nombre", dataKey: "nombre" },
        { title: "Apellido 1", dataKey: "apellido1" },
        { title: "Apellido 2", dataKey: "apellido2" },
        { title: "Telefono", dataKey: "telefono" },
        { title: "Correo", dataKey: "correo" },
      ];
      var doc = new jsPDF("p", "pt", "a4");      
      var img = new Image(); //this mount a variable to img
      img.src = "/images/MarcaAgua.jpeg"; //asign the src to the img variable
      doc.addImage(img, 'png', 470, 10, 90, 60);
      doc.text("Reporte de personas", 40, 50);
      doc.text("Fecha:" + this.fechaActual, 40, 70);
      doc.text("Sendero los matapalos", 40, 20, );
      doc.autoTable(columns, vm.personas.data,  {
        theme: 'grid',
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
      });

      doc.save("Reportepersonas.pdf");
    },
    cargarPersona() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/ReportePersona/solo100")
          .then(({ data }) => (this.personas = data.data));
      }
    },
  },
  mounted() {
    let pluginJSPDF = document.createElement("script");
    pluginJSPDF.setAttribute(
      "src",
      "https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"
    );
    document.head.appendChild(pluginJSPDF);

    let JSPDFLib = document.createElement("script");
    JSPDFLib.setAttribute(
      "src",
      "https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"
    );
    document.head.appendChild(JSPDFLib);
  },

  created() {
    this.$Progress.start();
    this.cargarPersona();
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
#page {
  width: 90%;
  color: black;
  background: white;
}
.card-body {
  font-size: 1.2rem;
  margin: 15px 5px 5px 45px;
}

.btn {
  margin: 5px;
}
.Encabezado {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: space-around;
  padding: 5px;
  border-bottom: 1px solid #14c514;
  background: #bababb8c;
}
h1,
.h1 {
  width: 90%;
  font-size: 2.25rem;
}
thead {
  background: #3bd99f;
  color: #343434de;
}
.titulo {
  text-align: center;
  margin: 15px;
  background: #3bd99f;
  color: #354942;
}
.table {
  border-bottom: 2px solid #f2f2f2;
}

h3 {
  padding: 10px;
}
.total {
  text-align: end;
  margin: 5px;
  font-size: 1.2rem;
  background: #f2f2f2;
  padding: 10px;
  color: #354942;
}
.Pie-Datos {
  text-align: start;
  margin: 5px;
  font-size: 1.2rem;
  padding: 10px;
  color: #354942;
}
td {
  padding: 5px;
  padding-left: 5px;
}
.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: 0.25rem;
  justify-content: space-evenly;
}
</style>
