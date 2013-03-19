class CreateMailData < ActiveRecord::Migration
  def change
    create_table :mail_data do |t|
      t.string :email
      t.string :enckey
      t.datetime :created_at

      t.timestamps
    end
  end
end
