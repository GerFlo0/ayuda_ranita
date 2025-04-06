from flask import Flask, render_template, request
import psycopg2
import consts as C

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html', queries=C.CONSULTS)

@app.route('/query', methods=['POST'])
def query():
    selected_query_name = request.form['selected_query']
    query = C.CONSULTS.get(selected_query_name)

    records = None
    columns = None
    if query:
        try:
            conn = psycopg2.connect(**C.DB_PARAMS)
            cursor = conn.cursor()
            
            cursor.execute("SELECT * FROM winequality_red WHERE "+query + ";")
            records = cursor.fetchall()
            columns = [desc[0] for desc in cursor.description]
            
            cursor.close()
            conn.close()
        except Exception as e:
            print(f"Error: {e}")
    
    return render_template('index.html', records=records, columns=columns, queries=C.CONSULTS, selected_query=selected_query_name, query=query)

if __name__ == '__main__':
    app.run(debug=True)
