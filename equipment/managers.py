from django.db import models
from django.db import connection

class EquipmentManager(models.Manager):
    def get_maintenance(self, aquarium_id):
        return self.raw(
            """SELECT Equipment.equipmentID, maintenance, action, 
            MAX(logDate) AS lastMaint, 
            DATEDIFF(NOW(), MAX(logDate)) AS daysSinceMaint 
            FROM Equipment 
            LEFT OUTER JOIN EquipmentLog ON EquipmentLog.equipmentID = Equipment.equipmentID 
            WHERE Equipment.aquariumID = %s 
            GROUP BY Equipment.equipmentID""",
            [aquarium_id])