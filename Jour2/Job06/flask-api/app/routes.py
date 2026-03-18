from flask import Blueprint, jsonify, request
from datetime import datetime

main = Blueprint('main', __name__)

# Base de données simulée
users_db = [
    {'id': 1, 'name': 'Alice'},
    {'id': 2, 'name': 'Bob'}
]

@main.route('/')
def index():
    return jsonify({
        'message': 'Hello Docker + Flask!',
        'timestamp': datetime.now().isoformat()
    })

@main.route('/health')
def health():
    return jsonify({'status': 'ok'})

@main.route('/api/users', methods=['GET'])
def get_users():
    return jsonify(users_db)


@main.route('/api/users', methods=['POST'])
def create_user():
    data = request.get_json()

    # Validation basique
    if not data or 'name' not in data:
        return jsonify({'error': 'Le champ "name" est requis'}), 400

    new_user = {
        'id': len(users_db) + 1,
        'name': data['name']
    }
    users_db.append(new_user)

    return jsonify(new_user), 201