class AddIpToMailData < ActiveRecord::Migration
  def change
    add_column :mail_data, :ip, :string
  end
end
