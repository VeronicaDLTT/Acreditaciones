'use strict';
import {pdf} from "../../spark-main/spark/module/presentation/pdf.js";
var pd = new pdf();
var obj = {
    pdf_url: '../../archivos/Marco_De_Referencia_2018_Ingenierias.pdf',
    start_page_num: 1,
    css:{
        canvas: '#pdf-render'
    } 
}
pd.rander(obj);