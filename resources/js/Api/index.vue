<script>
import axios from "axios";
export default {
    methods: {
        async handleProduct(data){
            try {
                await axios.post('http://localhost:8000/api/create', data);
            } catch (error) {
                console.log(error);
            }
        },
        async findProduct(id){
            try {
                const responce = await axios.get('http://localhost:8000/api/product/' + id);
                return responce.data;
            } catch (error) {
                console.log(error);
            }
        },
    }
}
</script>
