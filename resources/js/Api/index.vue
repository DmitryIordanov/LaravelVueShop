<script>
import axios from "axios";
export default {
    methods: {
        async handleProduct(data){
            await axios.post('http://localhost:8000/api/create', data);
        },
        async findProduct(id){
            const responce = await axios.get('http://localhost:8000/api/product/' + id);
            return responce.data;
        }
    }
}
</script>
